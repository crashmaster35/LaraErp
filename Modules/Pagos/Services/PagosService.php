<?php

namespace Modules\Pagos\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Pagos\Entities\Payment;
use \Carbon\Carbon;

class PagosService
{

  public function __construct()
  {

  }

  public function getPaymetsByStudentId($id)
  {
    return Payment::where('student_id', $id)->get();
  }

  public function getAllStudentsWithMat()
  {
    return Payment::where('matricula', '<>', null)->get();
  }

  public function getStudentById($id)
  {
    return Payment::where('id', $id)->first();
  }

  public function update($student)
  {
    $sid = $student['id'];
    unset($student['id']);
    unset($student['_method']);
    unset($student['_token']);
    $date = $student['fecha_nac'];
    $student['fecha_nac'] = Carbon::parse($date);
    return Payment::where('id', $sid)->update($student);
  }

  public function store($student)
  {
    unset($student['_method']);
    unset($student['_token']);
    $date = $student['fecha_nac'];
    $student['fecha_nac'] = Carbon::parse($date);

    return Payment::create($student);
  }

}
