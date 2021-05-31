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

class PublicController extends Controller
{
    public function __construct (  )
    {
    }


}
