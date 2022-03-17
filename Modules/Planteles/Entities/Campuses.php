<?php

namespace Modules\Planteles\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class campuses extends Model
{
    protected $table = 'campuses';
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'whatsapp'
    ];

    protected static function newFactory()
    {
        return \Modules\Planteles\Database\factories\CampusesFactory::new();
    }
}
