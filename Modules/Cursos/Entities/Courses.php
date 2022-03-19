<?php

namespace Modules\Cursos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class courses extends Model
{
    protected $table = 'courses';

    use HasFactory;

    protected $fillable = [
        'name',
        'lenght'
    ];

    protected static function newFactory()
    {
        return \Modules\Cursos\Database\factories\CoursesFactory::new();
    }
}
