<?php

namespace Modules\Planteles\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Planteles\Entities\campuses;
use \Carbon\Carbon;

class CampusesService
{

  public function __construct()
  {

  }

  public function getAllCampuses()
  {
    return Campuses::all();
  }

  public function getCampusById($id)
  {
    return Campuses::where('id', $id)->first();
  }

  public function update($campus)
  {
    $sid = $campus['id'];
    unset($campus['id']);
    unset($campus['_method']);
    unset($campus['_token']);
    return Campuses::where('id', $sid)->update($campus);
  }

  public function store($campus)
  {
    unset($campus['_method']);
    unset($campus['_token']);

    return Campuses::create($campus);
  }

}
