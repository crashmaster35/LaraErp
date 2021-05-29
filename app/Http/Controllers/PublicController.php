<?php
/**
 * Este archivo funciona como interfase entre los modulos creados y los diferentes controladores, de esta manera
 * cuando se crea un modulo unicamente se debe llamar al Public Controller y sus diferentes metodos
 * para realizar las acciones necesarias dentro del sistema. D
 *
 * Unicamente se llamarán aqui adentro todos los controladores y se creará un puente desde los modulos, para no permitir
 * que desde cualquier modulo llamen a cualquier controlador.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ModuleController;

class PublicController extends Controller
{
    public function __construct ( ModuleController $moduleController )
    {
      $this->moduleController = $moduleController;
    }


    /**
     * Esta función devuelve la lista de categorías de los modulos.
     *
     * La información la toma desde el ModuleController global
     *
     * @param 
     *      $module es la colceccion de modulos para obtener sus categorias.
     *      $display es un boleano que indica: 
     *        true = Solo mostrar los que son desplegables
     *        false = Mostrar todos
     */
    public function getCategories ($module, $display)
    {
      return $this->moduleController->getCategories($module, $display);
    }
}
