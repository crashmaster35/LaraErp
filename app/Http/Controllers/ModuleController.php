<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            if ($display == true) {
                $modDisp = config($module->getLowerName() . '.display', 'true');

                if ($modDisp == true) {
                    $category = config($module->getLowerName() . '.category', '');

                    if (!in_array($category, $list)) {
                        $list[] = $category;
                    }
                }
            } else {
                $category = config($module->getLowerName() . '.category', '');

                if (!in_array($category, $list)) {
                    $list[] = $category;
                }
            }
        }

        return $list;
    }
}
