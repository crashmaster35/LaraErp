<?php

namespace Modules\Planteles\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;

use Modules\Planteles\Services\CampusesService;

class CampusesController extends Controller
{
    public function __construct(CampusesService $campusesService)
    {
        $this->campusesService = $campusesService;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ComponentService $componentService)
    {
        $campuses = $this->campusesService->getAllCampuses();

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'planteles',
            'dtId' => 'CampusesTable',
            'dtServerSide' => 'false',
            'dtData' => $campuses->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                  'data' => 'id',
                  'url' => url('/planteles/**field=id**'),
                ],
                [
                  'title' => 'Plantel',
                  'data' => 'name',
                ],
                [
                  'title' => 'Dirección',
                  'data' => 'address',
                ],
                [
                  'title' => 'Telefono',
                  'data' => 'phone',
                ],
                [
                  'title' => 'Correo Electrónico',
                  'data' => 'email',
                ],
                [
                  'title' => 'WhatsApp',
                  'data' => 'whatsapp',
                ]
            ]
        ]);

        return view('planteles::index', ['dtObjectCampuses' => $object]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('planteles::show', ['campus' => null]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($this->campusesService->store($request->all())) {
            return redirect()->route('showCampusList')->with('successmsg', 'El Plantel ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showCampusList')->with('errormsg', 'Hubo un problema al guardar el Plantel, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('planteles::show', ['campus' => $this->campusesService->getCampusById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('planteles::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ($this->campusesService->update($request->all())) {
            return redirect()->route('showCampusList')->with('successmsg', 'El Plantel ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showCampusList')->with('errormsg', 'Hubo un problema al guardar el Plantel, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
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
