<?php

namespace Modules\Becas\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Becas\Entities\Becas;
use \Carbon\Carbon;

class BecasService
{

  public function __construct()
  {

  }

  public function getAllDiscounts($with = null)
  {
        if ($with == null)
            return Becas::all();
        else
            return Becas::with($with)->get();
  }

  public function getDiscountsById($id)
  {
    return Becas::where('id', $id)->first();
  }

  public function update($discount)
  {
    $sid = $discount['id'];
    unset($discount['id']);
    unset($discount['_method']);
    unset($discount['_token']);
    return Becas::where('id', $sid)->update($discount);
  }

  public function store($discount)
  {
    unset($discount['_method']);
    unset($discount['_token']);

    return Becas::create($discount);
  }

}
