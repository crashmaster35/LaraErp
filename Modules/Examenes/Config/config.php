<?php
/************************************************************************************************
  Este archivo cuenta con la configuración completa del modulo.

  Sus variables son:

  name            : Especifica el nombre del modulo
  category        : Categoria a la que se asignará el modulo
  description     : Descripcion del modulo para mostrarlo dentro de la seccion de modulos
  required        : Especifica si el modulo es requerido, y no permite su desactivación.
  display         : true/false que indica si se va a mostrar dentro del modulo Modulos.
  hasSettings     : Especifica si el modulo cuenta con una sección de configuración
************************************************************************************************/

return [
    'name' => 'Examenes',
    'category' => 'ALUMNOS',
    'description' => 'Este módulo controla los examenes que tendran los alumnos, extraordinarios y ordinarios.',
    'required' => false,
    'display' => true,
    'hasSettings' => false
];
