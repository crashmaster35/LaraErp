<?php

namespace Modules\Module\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Module;

class ModuleController extends Controller
{

    public function __construct (  )
    {
    }
    /**
     * Muestra el listado de modulos, permite activarlos/desactivarlos y si hay configurador acceder a el.
     * @return Renderable
     */
    public function index()
    {
        $mod = [];

        $modules = Module::toCollection();
        
        $categories = $this->getCategories($modules, true);

        foreach ($modules as $module) {
            if ($module->isEnabled() == true) {
                $mod['id'] = $module->getName();
                $mod['name'] = config($module->getLowerName() . '.name', '');
                $mod['status'] = ($module->isEnabled() == 1) ? 'enabled' : 'disabled';
                $mod['required'] = config($module->getLowerName() . '.required', false);
                $mod['category'] = config($module->getLowerName() . '.category', '');
                $mod['description'] = config($module->getLowerName() . '.description', '');
                $mod['display'] = config($module->getLowerName() . '.display', true);
                $mod['hasSettings'] = config($module->getLowerName() . '.hasSettings', false);
                $mod['path'] = $module->getLowerName();
            } else {
                $config = include(base_path() . '/Modules/' .  $module->getName() . '/Config/config.php');
                $mod['id'] = $module->getName();
                $mod['name'] = $config['name'];
                $mod['status'] = ($module->isEnabled() == 1) ? 'enabled' : 'disabled';
                $mod['required'] = $config['required'];
                $mod['category'] = $config['category'];
                $mod['description'] = $config['description'];
                $mod['display'] = $config['display'];
                $mod['hasSettings'] = $config['hasSettings'];
                $mod['path'] = $module->getLowerName();
            }
            $list[] = $mod;            
        }
        return view('module::index', ['modules' => $list, 'categories' => $categories]);
    }


    public function toggleModule(Request $request)
    {
        $data = $request->all();

        $module = Module::find($data['module']);

        if ($module->isEnabled() == "false") {
            $module->disable();
        } else {
            $module->enable();
        }

        return redirect('/module');
    }

    /**
     * Obtiene un listado de las categorias  para los modulos
     *
     * @return categories
     */
    public function getCategories($modules, $display)
    {
        $list = [];
        $modDisp = false;

        foreach ($modules as $module) {
            $enable = $module->isEnabled();
            if ($enable) {
                $conf['modDisp'] = config($module->getLowerName() . '.display', 'true');
                $conf['category'] = config($module->getLowerName() . '.category', '');
            } else {
                $config = include(base_path() . '/Modules/' .  $module->getName() . '/Config/config.php');
                $conf['modDisp'] = $config['display'];
                $conf['category'] = $config['category'];
            }

            if ($display == true) {
                $modDisp = $conf['modDisp'];

                if ($modDisp == true) {
                    $category = $conf['category'];

                    if (!in_array($category, $list)) {
                        $list[] = $category;
                    }
                }
            } else {
                $category = $conf['category'];

                if (!in_array($category, $list)) {
                    $list[] = $category;
                }
            }
        }
        return $list;
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
