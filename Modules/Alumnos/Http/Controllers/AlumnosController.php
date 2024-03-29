<?php

namespace Modules\Alumnos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Alumnos\Services\AlumnosService;

class AlumnosController extends Controller
{
    public function __construct(AlumnosService $alumnosService)
    {
        $this->alumnosService = $alumnosService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ComponentService $componentService)
    {
        $students = $this->alumnosService->getAllStudentsNoMat();
        $studentsM = $this->alumnosService->getAllStudentsWithMat(['registered.group', 'registered.course', 'registered.group.campus']);

        //dd($studentsM);

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'alumnos',
            'dtId' => 'StudentsTable',
            'dtAjaxUrl' => url('/new-centers/owner_proc'),
            'dtServerSide' => 'false',
            'dtData' => $students->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/alumnos/**field=id**'),
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

        $studentsM = $this->getStudentsMParameters($studentsM);

        $objectM = $componentService->dataTableConfigObject([
            'dtName' => 'alumnosMat',
            'dtId' => 'StudentsMatTable',
            'dtServerSide' => 'false',
            'dtData' => $studentsM,
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 2,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/alumnos/**field=id**'),
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
                  'data' => 'plantel',
                ],
                [
                  'data' => 'grupo',
                ],
                [
                  'data' => 'curso',
                ],
                [
                  'title' => 'Fecha de Registro',
                  'data' => 'created_at',
                  'type' => 'date'
                ]
            ]
        ]);

        return view('alumnos::index', ['dtObjectAlumnos' => $object, 'dtObjectAlumnosMat' => $objectM]);
    }

    private function getStudentsMParameters($students) 
    {
        $st = [];
        $i = 0;
        
        //dd($students);

        foreach ($students as $student) {
            $st[$i]['id'] = $student->id;
            $st[$i]['matricula'] = $student->matricula;
            $st[$i]['nombres'] = $student->nombres;
            $st[$i]['ap_paterno'] = $student->ap_paterno;
            $st[$i]['ap_materno'] = $student->ap_materno;
            $st[$i]['fecha_nac'] = $student->fecha_nac;
            $st[$i]['email'] = $student->email;
            $st[$i]['celular'] = $student->celular;
            $st[$i]['tel_casa'] = $student->tel_casa;
            $st[$i]['created_at'] = $student->created_at;
            $st[$i]['grupo'] = '';
            $st[$i]['plantel'] = '';
            $st[$i]['curso'] = '';

            foreach ($student->registered as $register) {
                foreach ($register->group as $group) {
                    $st[$i]['grupo'] = $group->name??'';
                    $st[$i]['plantel'] = $group->campus->name??'';
                }

                foreach ($register->course as $course) {
                    $st[$i]['curso'] = $course->name??'';
                }
            }

            $i++;
        }

        return $st;
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('alumnos::show', ['student' => null]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($this->alumnosService->store($request->all())) {
            return redirect()->route('showStudentList')->with('successmsg', 'El Alumno ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showStudentList')->with('errormsg', 'Hubo un problema al guardar al Alumno, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('alumnos::show', ['student' => $this->alumnosService->getStudentById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('alumnos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ($this->alumnosService->update($request->all())) {
            return redirect()->route('showStudentList')->with('successmsg', 'El Alumno ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showStudentList')->with('errormsg', 'Hubo un problema al guardar al Alumno, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
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
