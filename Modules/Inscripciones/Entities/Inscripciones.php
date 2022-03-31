<?php

namespace Modules\Inscripciones\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscripciones extends Model
{
    protected $table = 'registration';

    use HasFactory;

    protected $fillable = [
        'student_id',
        'group_id',
        'course_id'
    ];
    protected static function newFactory()
    {
        return \Modules\Inscripciones\Database\factories\InscripcionesFactory::new();
    }
}
