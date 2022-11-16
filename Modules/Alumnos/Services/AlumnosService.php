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
    return Alumnos::all();
  }

  public function getAllStudentsNoMat()
  {
    return Alumnos::where('matricula', '=', null)->get();
  }

  public function getStudentsInGroups()
  {
    //return Alumnos::where('matricula', '=', null)->get();
    return Alumnos::select('registration.id as id', 'students.id as student_id', 'matricula', 'nombres', 'ap_paterno', 'ap_materno','groups.name as grupo', 'courses.name as carrera')
                        ->join('registration', 'students.id', '=', 'registration.student_id')
                        ->join('groups', 'registration.group_id', '=', 'groups.id')
                        ->join('courses', 'groups.courses_id', '=', 'courses.id')
                        ->orderBy('students.matricula')
                        ->get();
    dd($alumnos);
  }


  public function getAllStudentsWithMat($with = null)
  {
    if (!is_null($with)) {
      return Alumnos::where('matricula', '<>', null)->with($with)->get();
    } else {
      return Alumnos::where('matricula', '<>', null)->get();
    }
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
