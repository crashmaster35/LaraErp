<?php

namespace Modules\Materias\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'course_id',
        'hours',
        'period',
        'what_period'
    ];

    protected static function newFactory()
    {
        return \Modules\Materias\Database\factories\ClassesFactory::new();
    }
}
