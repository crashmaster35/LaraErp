<?php

namespace Modules\Alumnos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Modules\Inscripciones\Entities\Inscripciones;

class alumnos extends Model
{
    protected $table = 'students';
    use HasFactory;

    protected $fillable = [
        'matricula',
        'nombres',
        'ap_paterno',
        'ap_materno',
        'fecha_nac',
        'lugar_nac',
        'anos_cumplidos',
        'direccion',
        'ciudad',
        'email',
        'celular',
        'tel_casa',
        'nacionalidad',
        'nacionalidad_ext',
        'peso',
        'altura',
        'talla_pantalon',
        'tala_playera',
        'secundaria',
        'secu_dir',
        'preparatoria',
        'prepa_dir',
        'universidad',
        'uni_dir',
        'licenciatura',
        'nombre_rep',
        'ident',
        'parentesco',
        'estudio_economico',
        'vivienda',
        'ocup_rep',
        'estudios_rep',
        'activo'];

    protected static function newFactory()
    {
        return \Modules\Alumnos\Database\factories\AlumnosFactory::new();
    }

    public function registered() 
    {
      return $this->hasMany(\Modules\Inscripciones\Entities\Inscripciones::class, 'student_id', 'id');
    }
}
