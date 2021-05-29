<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Module;

class ModuleController extends Controller
{
    /**
     * Muestra el listado de modulos, permite activarlos/desactivarlos y si hay configurador acceder a el.
     * @return Renderable
     */
    public function index()
    {
        $modules = Module::toCollection();
        
        foreach ($modules as $module) {
            $mod['name'] = $module->getName();
            $mod['status'] = ($module->isEnabled() == 1) ? 'enabled' : 'disabled';
            $mod['required'] = config($module->getLowerName() . '.required', false);
            $mod['hasConfig'] = config($module->getLowerName() . '.hasConfig', false);
            $mod['category'] = config($module->getLowerName() . '.category', '');
            $list[] = $mod;            
        }

        return view('module::index', ['modules' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('module::create');
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
        return view('module::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('module::edit');
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
