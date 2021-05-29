<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Module;
use App\Http\Controllers\PublicController;

class ModuleController extends Controller
{

    public function __construct ( PublicController $publicController )
    {
        $this->publicController = $publicController;
    }
    /**
     * Muestra el listado de modulos, permite activarlos/desactivarlos y si hay configurador acceder a el.
     * @return Renderable
     */
    public function index()
    {
        $modules = Module::toCollection();
        
        $categories = $this->publicController->getCategories($modules, true);

        foreach ($modules as $module) {
            $mod['name'] = config($module->getLowerName() . '.name', '');
            $mod['status'] = ($module->isEnabled() == 1) ? 'enabled' : 'disabled';
            $mod['required'] = config($module->getLowerName() . '.required', false);
            $mod['hasConfig'] = config($module->getLowerName() . '.hasConfig', false);
            $mod['category'] = config($module->getLowerName() . '.category', '');
            $mod['description'] = config($module->getLowerName() . '.description', '');
            $mod['display'] = config($module->getLowerName() . '.display', true);
            $list[] = $mod;            
        }

        return view('module::index', ['modules' => $list, 'categories' => $categories]);
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
