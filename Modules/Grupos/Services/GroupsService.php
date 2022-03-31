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

  public function getAllGroups($with = null)
  {
        if ($with == null)
            return Grupos::all();
        else 
            return Grupos::with($with)->get();
  }

  public function getGroupsById($id)
  {
    return Grupos::where('id', $id)->first();
  }

  public function getGroupByCampusCourse($campus, $course, $with = null)
  {
    if ($with)
        return Grupos::where('campuses_id', $campus)->where('courses_id', $course)->with($with)->get();
    else
        return Grupos::where('campuses_id', $campus)->where('courses_id', $course)->get();
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
