<?php

namespace Modules\Materias\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Cursos\Services\CoursesService;
use Modules\Materias\Services\ClassesService;


class MateriasController extends Controller
{
    public function __construct(CoursesService $coursesService, ClassesService $classesService)
    {
        $this->coursesService = $coursesService;
        $this->classesService = $classesService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ComponentService $componentService)
    {
        $courses = $this->coursesService->getAllCourses();

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'planteles',
            'dtId' => 'CampusesTable',
            'dtServerSide' => 'false',
            'dtData' => $courses->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/materias/curso/**field=id**'),
                ],
                [
                  'title' => 'Curso',
                  'data' => 'name',
                ],
                [
                  'title' => 'Duración en Meses',
                  'data' => 'length',
                ],
                [
                  'title' => 'Periodo',
                  'data' => 'period',
                ],
                [
                  'title' => 'No. de Periodos',
                  'data' => 'total_period',
                ],
            ]
        ]);
        return view('materias::index', ['dtObjectCourses' => $object]);
    }

    public function getClasses($cid, ComponentService $componentService)
    {
        $classes = $this->classesService->getAllClassesByCourseId($cid);

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'materias',
            'dtId' => 'MateriasTable',
            'dtServerSide' => 'false',
            'dtData' => $classes->toArray(),
            'dtExport' => 'false',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                  'title' => 'ID Materia',
                  'data' => 'id',
                  'url' => url('/materias/curso/'.$cid.'/materia/**field=id**'),
                ],
                [
                  'title' => 'Materia',
                  'data' => 'name',
                ],
                [
                  'title' => 'Horas Clase',
                  'data' => 'hours',
                ],
                [
                  'title' => 'Periodo',
                  'data' => 'period',
                ],
                [
                  'title' => 'Periodo',
                  'data' => 'what_period',
                ],
            ]
        ]);
        return view('materias::classes', ['dtObjectClasses' => $object, 'courseId' => $cid]);
    }



    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($cid)
    {
        return view('materias::show', ['classes' => null, 'cid' => $cid]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store($cid, Request $request)
    {
        if ($this->classesService->store($request->all(), $cid)) {
            return redirect()->route('showClassesList', ['cid' => $request->course_id])->with('successmsg', 'La materia ha sido guardada satisfactoriamente');
        } else {
            return redirect()->route('showClassesList', ['cid' => $request->course_id])->with('errormsg', 'Hubo un problema al guardar la materia, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($cid, $mid)
    {
        return view('materias::show', ['cid' => $cid,'classes' => $this->classesService->getClassesById($mid)]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($cid, $id)
    {

        return view('materias::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        if ($this->classesService->update($request->all())) {
            return redirect()->route('showClassesList', ['cid' => $request->course_id])->with('successmsg', 'La materia ha sido guardada satisfactoriamente');
        } else {
            return redirect()->route('showClassesesList', ['cid' => $request->course_id])->with('errormsg', 'Hubo un problema al guardar la Materia, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
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
