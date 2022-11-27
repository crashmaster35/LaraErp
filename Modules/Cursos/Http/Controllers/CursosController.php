<?php

namespace Modules\Cursos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Cursos\Services\CoursesService;

class CursosController extends Controller
{
    public function __construct(CoursesService $coursesService)
    {
        $this->coursesService = $coursesService;
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
                  'url' => url('/cursos/**field=id**'),
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

        return view('cursos::index', ['dtObjectCourses' => $object]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('cursos::show', ['course' => null]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
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
        return view('cursos::show', ['course' => $this->coursesService->getCourseById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('cursos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ($this->coursesService->update($request->all())) {
            return redirect()->route('showCoursesList')->with('successmsg', 'El Curso ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showCoursesList')->with('errormsg', 'Hubo un problema al guardar el Curso, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
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
