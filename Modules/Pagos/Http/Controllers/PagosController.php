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

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($id, ComponentService $componentService)
    {
        $payments = $this->pagosService->getPaymetsByStudentId($id);
        $student = $this->alumnosService->getStudentById($id);

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
            ]
        ]);

        return view('pagos::index', ['dtObjectPayments' => $object, 'id' => $id, 'student' => $student]);

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
        dd($request->all());
        if ($this->coursesService->store($request->all())) {
            return redirect()->route('showCoursesList')->with('successmsg', 'El Curso ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showCoursesList')->with('errormsg', 'Hubo un problema al guardar el Curso, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
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
