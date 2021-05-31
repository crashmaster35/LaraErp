<?php

namespace Modules\Warehouse\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockConfig extends Model
{
    use HasFactory;

    protected $fillable =
    [
      'id',
      'decrement_stock_clients',
      'increment_stock_providers',
      'negative_stock',
      'positive_stock',
      'min_max_stock',
      'min_notification'
    ];

    
}
