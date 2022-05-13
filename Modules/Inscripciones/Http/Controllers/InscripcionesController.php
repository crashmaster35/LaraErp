<?php

namespace Modules\Inscripciones\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Alumnos\Services\AlumnosService;
use Modules\Grupos\Services\GroupsService;
use Modules\Cursos\Services\CoursesService;
use Modules\Planteles\Services\CampusesService;
use Modules\Inscripciones\Services\InscripcionesService;

use \Carbon\Carbon;

class InscripcionesController extends Controller
{
    public function __construct(AlumnosService $alumnosService, GroupsService $groupsService, CoursesService $coursesService, CampusesService $campusesService, InscripcionesService $inscripcionesService)
    {
        $this->alumnosService = $alumnosService;
        $this->groupsService = $groupsService;
        $this->coursesService = $coursesService;
        $this->campusesService = $campusesService;
        $this->inscripcionesService = $inscripcionesService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
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
                  'url' => url('/inscripciones/**field=id**'),
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

        return view('inscripciones::index', ['dtObjectAlumnos' => $object]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('inscripciones::show', ['group' => null]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $student = $this->alumnosService->getStudentById($id);
        $campus = $this->campusesService->getAllCampuses();
        $courses = $this->inscripcionesService->getAllCoursesExcept($id);
        $groups = $this->groupsService->getAllGroups();
        $camp = [];
        $cour = [];
        $grou = [];

        foreach ($campus as $plantel) {
            $camp[$plantel->id] = $plantel->name;
        }

        foreach ($courses as $cursos) {
            $cour[$cursos->id] = $cursos->name;
        }

        foreach ($groups as $grupos) {
            $grou[$grupos->id] = $grupos->name;
        }

        return view('inscripciones::show', ['group' => null, 'campuses' => $camp, 'courses' => $cour, 'groups' => $grou, 'student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('inscripciones::edit');
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

    public function getGroup(Request $request)
    {
        $group = $this->groupsService->getGroupByCampusCourse($request->idcampus, $request->idcourse);

        $gr = [];

        foreach ($group as $grupo) {
            $total = $this->inscripcionesService->getStudentsOnGroup($grupo->id);
            $cant = $grupo->total - $total;
            if ($cant > 0) {
                $gr[$grupo->id] = $grupo->name . ' ('.$cant.')';
            }
        }

        return json_encode($gr);
    }

    public function postRegister(Request $request)
    {
        $idgroup = $request->idgroup;
        $idcourse = $request->idcourse;
        $idstudent = $request->idstudent;
        $regnumber = Carbon::now()->format('y') . str_pad($idcourse, 2, '0', STR_PAD_LEFT) . str_pad($idgroup, 2, '0', STR_PAD_LEFT) . '-' . $idstudent;

        $inscripcion = $this->inscripcionesService->registerStudent($idstudent, $idgroup, $idcourse);

        if ($inscripcion) {
            /*$register = $this->inscripcionesService->createInvoices($idstudent, $idgroup);
            if ($register) {*/
                $mat = $this->inscripcionesService->addRegisterNumber($idstudent, $regnumber);

                return json_encode(['error' => false, 'msg' => 'El alumno fue inscrito con exito. Su numero de matricula es: '. $mat] );
/*            } else {
                return json_encode(['error' => true, 'msg' => 'El alumno ya se encuentra registrado en ese curso.'] );
            }
*/
        } else {
            return json_encode(['error' => true, 'msg' => 'El alumno ya se encuentra registrado en ese grupo.'] );
        }
    }
}
