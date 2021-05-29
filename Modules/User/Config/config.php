<?php
/************************************************************************************************
  Este archivo cuenta con la configuración completa del modulo. 

  Sus variables son:

  name            : Especifica el nombre del modulo
  required        : Especifica si el modulo es requerido, y no permite su desactivación.
  hasConfig       : Especifica si el modulo cuenta con una sección de configuración
************************************************************************************************/

return [
    'name' => 'Usuarios',
    'category' => 'USUARIOS',
    'required' => true,             
    'hasConfig' => true,  
    'description' => 'Este modulo controla todos los usuarios dentro del sistema. Altas/Bajas/Cambios de usuarios, contraseñas, permisos.'       
];
