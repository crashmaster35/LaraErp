<?php

namespace Modules\Grupos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Grupos\Services\GroupsService;
use Modules\Cursos\Services\CoursesService;
use Modules\Planteles\Services\CampusesService;

class GruposController extends Controller
{

    public function __construct(GroupsService $groupsService, CoursesService $coursesService, CampusesService $campusesService)
    {
        $this->groupsService = $groupsService;
        $this->coursesService = $coursesService;
        $this->campusesService = $campusesService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ComponentService $componentService)
    {
        $groups = $this->groupsService->getAllGroups(['campus', 'course']);

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'planteles',
            'dtId' => 'CampusesTable',
            'dtServerSide' => 'false',
            'dtData' => $groups->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                    'data' => 'id',
                    'url' => url('/grupos/**field=id**'),
                ],
                [
                    'title' => 'Grupo',
                    'data' => 'name',
                ],
                [
                    'title' => 'Plantel',
                    'data' => 'campus->name',
                ],
                [
                    'title' => 'Curso',
                    'data' => 'course->name',
                ],
                [
                    'Total Alumnos',
                    'data' => 'total'
                ],
                [
                    'title' => 'Observaciones',
                    'data' => 'notes'
                ]
            ]
        ]);

        return view('grupos::index', ['dtObjectGroups' => $object]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $campus = $this->campusesService->getAllCampuses();
        $courses = $this->coursesService->getAllCourses();
        $camp = [];
        $cour = [];

        foreach ($campus as $plantel) {
            $camp[$plantel->id] = $plantel->name;
        }

        foreach ($courses as $cursos) {
            $cour[$cursos->id] = $cursos->name;
        }

        return view('grupos::show', ['group' => null, 'campuses' => $camp, 'courses' => $cour]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($this->groupsService->store($request->all())) {
            return redirect()->route('showGroupsList')->with('successmsg', 'El Grupo ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showGroupsList')->with('errormsg', 'Hubo un problema al guardar el Grupo, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $campus = $this->campusesService->getAllCampuses();
        $courses = $this->coursesService->getAllCourses();
        $camp = [];
        $cour = [];

        foreach ($campus as $plantel) {
            $camp[$plantel->id] = $plantel->name;
        }

        foreach ($courses as $cursos) {
            $cour[$cursos->id] = $cursos->name;
        }

        return view('grupos::show', ['group' => $this->groupsService->getGroupsById($id), 'campuses' => $camp, 'courses' => $cour]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('grupos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ($this->groupsService->update($request->all())) {
            return redirect()->route('showGroupsList')->with('successmsg', 'El Grupo ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showGroupsList')->with('errormsg', 'Hubo un problema al guardar el Grupo, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
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
