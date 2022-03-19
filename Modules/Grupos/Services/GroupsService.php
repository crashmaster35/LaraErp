<?php

namespace Modules\Grupos\Services;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Auth;
use Modules\Grupos\Entities\Grupos;
use \Carbon\Carbon;

class GroupsService
{

  public function __construct()
  {

  }

  public function getAllGroups($with)
  {
    return Grupos::with($with)->get();
  }

  public function getGroupsById($id)
  {
    return Grupos::where('id', $id)->first();
  }

  public function update($group)
  {
    $sid = $group['id'];
    unset($group['id']);
    unset($group['_method']);
    unset($group['_token']);
    return Grupos::where('id', $sid)->update($group);
  }

  public function store($group)
  {
    unset($group['_method']);
    unset($group['_token']);

    return Grupos::create($group);
  }

}
