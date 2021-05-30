<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Module;

class ModuleController extends Controller
{
    

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

}
