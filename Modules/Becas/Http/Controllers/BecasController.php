<?php

namespace Modules\Becas\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\ComponentService;
use Modules\Becas\Services\BecasService;

class BecasController extends Controller
{
    public function __construct(BecasService $becasService)
    {
        $this->becasService = $becasService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ComponentService $componentService)
    {
        $discount = $this->becasService->getAllDiscounts();

        $object = $componentService->dataTableConfigObject([
            'dtName' => 'becas',
            'dtId' => 'discountsTable',
            'dtServerSide' => 'false',
            'dtData' => $discount->toArray(),
            'dtExport' => 'true',
            'dtSearchBox' => 'true',
            'dtCount' => 1,
            'dtColumns' => [
                [
                    'data' => 'id',
                    'url' => url('/becas/**field=id**'),
                ],
                [
                    'title' => 'Nombre',
                    'data' => 'name',
                ],
                [
                    'title' => 'Cantidad',
                    'data' => 'price',
                ],
                [
                    'title' => 'Tipo',
                    'data' => 'type',
                ],
                [
                    'title' => 'Operación',
                    'data' => 'sign',
                ]
            ]
        ]);

        return view('becas::index', ['dtObjectDiscounts' => $object]);    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('becas::show', ['becas' => null]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if ($this->becasService->store($request->all())) {
            return redirect()->route('showDiscountList')->with('successmsg', 'El Precio ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showDiscountList')->with('errormsg', 'Hubo un problema al guardar el Precio, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
        };
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('becas::show', ['becas' => $this->becasService->getDiscountsById($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('becas::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if ($this->becasService->update($request->all())) {
            return redirect()->route('showDiscountList')->with('successmsg', 'El Precio ha sido guardado satisfactoriamente');
        } else {
            return redirect()->route('showDiscountList')->with('errormsg', 'Hubo un problema al guardar el Precio, por favor intentelo mas tarde o contacte a su departamento de sistemas.');
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
