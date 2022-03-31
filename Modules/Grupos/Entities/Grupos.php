<?php

namespace Modules\Grupos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class grupos extends Model
{
    protected $table = 'groups';

    use HasFactory;

    protected $fillable = [
        'name',
        'courses_id',
        'campuses_id',
        'total',
        'notes'
    ];
    protected static function newFactory()
    {
        return \Modules\Grupos\Database\factories\GruposFactory::new();
    }

    public function campus()
    {
        return $this->belongsTo(\Modules\Planteles\Entities\Campuses::class, 'campuses_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(\Modules\Cursos\Entities\Courses::class, 'courses_id', 'id');
    }
}
