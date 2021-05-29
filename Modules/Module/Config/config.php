<?php
/************************************************************************************************
  Este archivo cuenta con la configuración completa del modulo. 

  Sus variables son:

  name            : Especifica el nombre del modulo
  required        : Especifica si el modulo es requerido, y no permite su desactivación.
  hasConfig       : Especifica si el modulo cuenta con una sección de configuración
************************************************************************************************/

return [
    'name' => 'Modulos',
    'category' => 'CONFIGURACION',
    'required' => true,             
    'hasConfig' => false,
    'description' => 'Este modulo controla todos los modulos instalados en LaraErp'       
];
