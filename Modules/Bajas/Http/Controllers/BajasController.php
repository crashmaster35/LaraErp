<?php

namespace Modules\Bajas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;
use Modules\Alumnos\Services\AlumnosService;
use Modules\Grupos\Services\GroupsService;
use Modules\Cursos\Services\CoursesService;
use Modules\Planteles\Services\CampusesService;
use Modules\Inscripciones\Services\InscripcionesService;



class BajasController extends Controller
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
        $students = $this->alumnosService->getStudentsInGroups();

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'register',
            'dtId' => 'RegistersTable',
            'dtServerSide' => 'false',
            'dtData' => $students->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtOrderCol' => 1,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/bajas/**field=id**'),
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
                  'title' => 'Grupo',
                  'data' => 'grupo'
                ],
                [
                  'title' => 'Carrera',
                  'data' => 'carrera',
                ]
            ]
        ]);

        return view('bajas::index', ['dtObjectBajas' => $object]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('bajas::create');
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
        return view('bajas::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('bajas::edit');
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
