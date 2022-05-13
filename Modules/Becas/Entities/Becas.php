<?php

namespace Modules\Becas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Becas extends Model
{
    protected $table = 'discounts';

    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'type',
        'sign',
    ];

    protected static function newFactory()
    {
        return \Modules\Becas\Database\factories\BecasFactory::new();
    }
}
