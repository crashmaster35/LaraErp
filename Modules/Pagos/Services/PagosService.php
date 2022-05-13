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

  public function getPaymentById($id)
  {
    return Payment::where('id', $id)->first();
  }

  public function update($payment)
  {
    $sid = $payment['id'];
    unset($payment['id']);
    unset($payment['_method']);
    unset($payment['_token']);
    $date = $payment['transaction_date'];
    $payment['transaction_date'] = Carbon::parse($date);
    return Payment::where('id', $sid)->update($payment);
  }

  public function store($payment)
  {
    unset($payment['_method']);
    unset($payment['_token']);
    $date = $payment['transaction_date'];
    $payment['transaction_date'] = Carbon::parse($date);
    return Payment::create($payment);
  }

}
