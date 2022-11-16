<?php

namespace Modules\Pagos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Alumnos\Services\AlumnosService;
use Modules\Pagos\Services\PagosService;

class PagosController extends Controller
{
    public function __construct(PagosService $pagosService, AlumnosService $alumnosService)
    {
        $this->pagosService = $pagosService;
        $this->alumnosService = $alumnosService;
    }

    public function index(ComponentService $componentService)
    {
        $students = $this->alumnosService->getAllStudents();

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'register',
            'dtId' => 'RegistersTable',
            'dtServerSide' => 'false',
            'dtData' => $students->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/pagos/**field=id**'),
                ],
                [
                  'data' => 'matricula',
                ],
                [
                  'data' => 'nombres',
                ],
                [
                  'title' => 'Apellido Paterno',
                  'data' => 'ap_paterno',
                ],
                [
                  'title' => 'Apellido Materno',
                  'data' => 'ap_materno',
                ],
                [
                  'title' => 'Fecha de Nacimiento',
                  'data' => 'fecha_nac',
                  'type' => 'date'
                ],
                [
                  'title' => 'Correo Electronico',
                  'data' => 'email',
                ],
                [
                  'data' => 'celular',
                ],
                [
                  'title' => 'Casa',
                  'data' => 'tel_casa',
                ],
                [
                  'title' => 'Fecha de Alta',
                  'data' => 'created_at',
                  'type' => 'date'
                ]
            ]
        ]);

        return view('pagos::index', ['dtObjectAlumnos' => $object]);
    }


    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index2($id, ComponentService $componentService)
    {
        $payments = $this->pagosService->getPaymetsByStudentId($id);
        $student = $this->alumnosService->getStudentById($id);
        //dd($student);

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'pagos',
            'dtId' => 'PaymentsTable',
            'dtServerSide' => 'false',
            'dtData' => $payments->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/pagos/'.$id.'/**field=id**'),
                ],
                [
                  'title' => 'Pago',
                  'data' => 'type',
                ],
                [
                  'title' => 'Cantidad',
                  'data' => 'amount',
                ],
                [
                  'title' => 'Descripción',
                  'data' => 'notes',
                ],
                [
                  'title' => 'Bank',
                  'data' => 'bank',
                ],
                [
                  'title' => 'Transacción',
                  'data' => 'transaction',
                ],
                [
                  'title' => 'Fecha de Transacción',
                  'data' => 'transaction_date',
                  'type' => 'date',
                ],
                [
                  'title' => 'Hora de Transacción',
                  'data' => 'transaction_time',
                ],
                [
                  'title' => 'Fecha de Registro',
                  'data' => 'created_at',
                  'type' => 'date',
                ]
            ],
            'dtExportBtns' =>   [
                [
                    'type' => 'print',          // Send directly the table to a printer.
                    'btn_title' => 'Imprimir documento',
                    'title' => 'CENTRO DE CAPACITACIÓN BRUMER\nESTADO DE CUENTA' . '\n' . $student->matricula . ' - ' . strtoupper($student->nombres) . ' ' . strtoupper($student->ap_paterno) . ' ' . strtoupper($student->ap_materno),
                    'filename' => 'edocta-'.$student->matricula.'-'.date('dmY'),
                    'orientation' => 'landscape',
                    'page_size' =>  'LETTER',
                    'message_top' => 'Estado de cuenta a la fecha de la impresión.',
                    'message_bottom' => '\n\rEste documento es unicamente informativo y no tiene validez si no esta firmado y sellado por la autoridad escolar.',

                ],[
                    'type' => 'csv',            // Export the table on csv format.
                    'btn_title' => 'Archivo CSV',
                    'title' => 'CENTRO DE CAPACITACIÓN BRUMER\nESTADO DE CUENTA' . '\n' . $student->matricula . ' - ' . strtoupper($student->nombres) . ' ' . strtoupper($student->ap_paterno) . ' ' . strtoupper($student->ap_materno),
                    'filename' => 'edocta-'.$student->matricula.'-'.date('dmY'),
                    'orientation' => 'landscape',
                    'page_size' =>  'LETTER',
                    'message_top' => 'Estado de cuenta a la fecha de la impresión.',
                    'message_bottom' => '\n\rEste documento es unicamente informativo y no tiene validez si no esta firmado y sellado por la autoridad escolar.',
                ],[
                    'type' => 'excel',          // Export the table on excel xls format.
                    'btn_title' => 'Archivo Excel XLS',
                    'title' => 'CENTRO DE CAPACITACIÓN BRUMER\nESTADO DE CUENTA' . '\n' . $student->matricula . ' - ' . strtoupper($student->nombres) . ' ' . strtoupper($student->ap_paterno) . ' ' . strtoupper($student->ap_materno),
                    'filename' => 'edocta-'.$student->matricula.'-'.date('dmY'),
                    'orientation' => 'landscape',
                    'page_size' =>  'LETTER',
                    'message_top' => 'Estado de cuenta a la fecha de la impresión.',
                    'message_bottom' => '\n\rEste documento es unicamente informativo y no tiene validez si no esta firmado y sellado por la autoridad escolar.',
                ],[
                    'type' => 'pdf',            // Export the table on adobe pdf format.
                    'btn_title' => 'Archivo PDF',
                    'title' => 'CENTRO DE CAPACITACIÓN BRUMER\nESTADO DE CUENTA' . '\n' . $student->matricula . ' - ' . strtoupper($student->nombres) . ' ' . strtoupper($student->ap_paterno) . ' ' . strtoupper($student->ap_materno),
                    'filename' => 'edocta-'.$student->matricula.'-'.date('dmY'),
                    'orientation' => 'landscape',
                    'page_size' =>  'LETTER',
                    'message_top' => 'Estado de cuenta a la fecha de la impresión.',
                    'message_bottom' => '\n\rEste documento es unicamente informativo y no tiene validez si no esta firmado y sellado por la autoridad escolar.',
                ]
            ],
        ]);

        return view('pagos::index2', ['dtObjectPayments' => $object, 'id' => $id, 'student' => $student]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id)
    {
        return view('pagos::show', ['pagos' => null, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($this->pagosService->store($request->all())) {
            return redirect()->route('paymentStudentList', $request->student_id)->with('successmsg', 'El pago ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('paymentStudentList', $request->student_id)->with('errormsg', 'Hubo un problema al guardar el pago, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pagos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pagos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
