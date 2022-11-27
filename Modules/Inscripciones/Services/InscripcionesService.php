<?php

namespace Modules\Inscripciones\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Inscripciones\Entities\Inscripciones;
use Modules\Cursos\Entities\Courses;
use Modules\Pagos\Entities\Payment;
use Modules\Grupos\Entities\Grupos;
use Modules\Alumnos\Entities\Alumnos;

use \Carbon\Carbon;

class InscripcionesService
{

  public function __construct()
  {

  }

  public function getAllCoursesExcept($id)
  {
      $register = Inscripciones::where('student_id', $id)->get();
      $already = [];
      foreach ($register as $reg) {
        $already[] = $reg->course_id;
      }

      $courses = Courses::whereNotIn('id', $already)->get();

      return $courses;
  }

  public function getStudentsIdByRegistrationId($id)
  {

      return Inscripciones::where('id', $id)->get(['student_id'])->first();
  }

  public function getStudentsOnGroup($group)
  {

      return Inscripciones::where('group_id', $group)->count();
  }

  public function registerStudent($idstudent, $idgroup, $idcourse)
  {
        if (Inscripciones::create(['student_id' => $idstudent, 'group_id' => $idgroup, 'course_id' => $idcourse])) {
            return true;
        } else {
            return false;
        }
  }

  public function createInvoices($student_id, $group_id) {
      $add = Payment::create(['student_id' => $student_id, 'group_id' => intval($group_id), 'number' => 1, 'type' => 'INSCRIPCION', 'amount' => env('REGISTER_TOTAL')]);
      $totalpays = $this->getTotalPaymentsFromGroup($group_id);

      if ($add) {
          for ($i=2; $i < $totalpays + 2; $i++) {
            $add = Payment::create(['student_id' => $student_id, 'group_id' => intval($group_id), 'number' => $i, 'type' => 'MENSUALIDAD', 'amount' => env('MONTHLY_CHARGE')]);
          }
          return true;
      } else {
          return false;
      }
  }

  public function getTotalPaymentsFromGroup($id) {
      $group = Grupos::where('id', $id)->first();
      $curso = Courses::where('id', $group->courses_id)->first();

      return $curso->length;
  }

  public function addRegisterNumber($idstudent, $regnumber)
  {
      $mat = Alumnos::where('id', $idstudent)->first();

      if ($mat->matricula == null) {
        $mat->matricula = $regnumber;
        $mat->save();
        return $regnumber;
      } else {
          return $mat->matricula;
      }
  }

  public function destroy($id)
  {
    if (Inscripciones::find($id)->delete()) {
        return true;
    } else {
      return false;
    }
  }
}
