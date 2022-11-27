<?php

namespace Modules\Materias\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Materias\Entities\Classes;
use \Carbon\Carbon;

class ClassesService
{

  public function __construct(Classes $classes)
  {
    $this->classes = $classes;

  }

  public function getAllClassesByCourseId($cid)
  {
    return Classes::where('course_id', $cid)->get();
  }

  public function getClassesById($mid)
  {
    return Classes::where('id', $mid)->first();
  }

  public function update($classes)
  {
    $mid = $classes['id'];
    unset($classes['id']);
    unset($classes['_method']);
    unset($classes['_token']);

    return Classes::where('id', $mid)->update($classes);
  }

  public function store($classes)
  {
    unset($classes['_method']);
    unset($classes['_token']);

    return Classes::create($classes);
  }
}
