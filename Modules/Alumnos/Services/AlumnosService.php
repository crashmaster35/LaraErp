<?php

namespace Modules\Alumnos\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Alumnos\Entities\Alumnos;
use \Carbon\Carbon;

class AlumnosService
{

  public function __construct()
  {

  }

  public function getAllStudents()
  {
    return Alumnos::where('matricula', null)->get();
  }
  
  public function getAllStudentsWithMat()
  {
    return Alumnos::where('matricula', '<>', null)->get();
  }

  public function getStudentById($id)
  {
    return Alumnos::where('id', $id)->first();
  }

  public function update($student)
  {
    $sid = $student['id'];
    unset($student['id']);
    unset($student['_method']);
    unset($student['_token']);
    $date = $student['fecha_nac'];
    $student['fecha_nac'] = Carbon::parse($date);
    return Alumnos::where('id', $sid)->update($student);
  }

  public function store($student)
  {
    unset($student['_method']);
    unset($student['_token']);
    $date = $student['fecha_nac'];
    $student['fecha_nac'] = Carbon::parse($date);
    
    return Alumnos::create($student);
  }

}
