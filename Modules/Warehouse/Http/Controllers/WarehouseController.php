<?php

namespace Modules\Warehouse\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Warehouse\Services\WarehouseServices;

class WarehouseController extends Controller
{
    public function __construct(WarehouseServices $warehouseServices)
    {
        $this->warehouseServices = $warehouseServices;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('warehouse::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('warehouse::create');
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function settings()
    {
        return view('warehouse::settings', ['config' => $this->warehouseServices->getConfig()]);
    }

     /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function setSettings(Request $request)
    {

        if ($this->warehouseServices->setConfig($request->all())) {
            
        } else {
            
        }

        return view('warehouse::settings', ['config' => $this->warehouseServices->getConfig()]);
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
        return view('warehouse::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('warehouse::edit');
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
