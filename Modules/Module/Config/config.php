<?php
/************************************************************************************************
  Este archivo cuenta con la configuración completa del modulo. 

  Sus variables son:

  name            : Especifica el nombre del modulo
  required        : Especifica si el modulo es requerido, y no permite su desactivación.
  hasConfig       : Especifica si el modulo cuenta con una sección de configuración
  description     : Descripcion del modulo para mostrarlo dentro de la seccion de modulos
  display         : true/false que indica si se va a mostrar dentro del modulo Modulos.
************************************************************************************************/

return [
    'name' => 'Modulos',
    'category' => 'CONFIGURACION',
    'description' => 'Este modulo controla todos los modulos instalados en LaraErp',
    'required' => true,             
    'hasConfig' => false,
    'display' => false,
    'hasSettings' => false
];
