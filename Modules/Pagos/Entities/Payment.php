<?php

namespace Modules\Pagos\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class payment extends Model
{
    protected $table = 'payments';

    use HasFactory;

    protected $fillable = [
        'student_id',
        'group_id',
        'number',
        'type',
        'amount',
        'notes',
        'bank',
        'transaction',
        'transaction_date',
        'transaction_time'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Pagos\Database\factories\PaymentFactory::new();
    }
}
