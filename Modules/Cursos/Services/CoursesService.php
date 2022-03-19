<?php

namespace Modules\Cursos\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Cursos\Entities\courses;
use \Carbon\Carbon;

class CoursesService
{

  public function __construct()
  {

  }

  public function getAllCourses()
  {
    return Courses::all();
  }

  public function getCourseById($id)
  {
    return Courses::where('id', $id)->first();
  }

  public function update($course)
  {
    $sid = $course['id'];
    unset($course['id']);
    unset($course['_method']);
    unset($course['_token']);
    return Courses::where('id', $sid)->update($course);
  }

  public function store($course)
  {
    unset($course['_method']);
    unset($course['_token']);

    return Courses::create($course);
  }

}
