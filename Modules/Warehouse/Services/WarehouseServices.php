<?php

namespace Modules\Warehouse\Services;

use \Modules\Warehouse\Http\Models\StockConfig;
use Illuminate\Support\Facades\Route;
use URL;

class WarehouseServices
{
    public function __construct(StockConfig $stockConfig)
    {
        $this->stockConfig = $stockConfig;
    }

    public function getConfig() 
    {
        return $this->stockConfig->first();
    }

    public function setConfig($data)
    {

      $record = $this->stockConfig->first();

      if (!$record) {
        $record = new $this->stockConfig;
      }

      $record->decrement_stock_clients = (array_key_exists('decrement_stock_clients', $data)?(($data['decrement_stock_clients'] == 'on')?true:false):false);
      $record->increment_stock_providers = (array_key_exists('increment_stock_providers', $data)?(($data['increment_stock_providers'] == 'on')?true:false):false);
      $record->negative_stock = (array_key_exists('negative_stock', $data)?(($data['negative_stock'] == 'on')?true:false):false);
      $record->positive_stock = (array_key_exists('positive_stock', $data)?(($data['positive_stock'] == 'on')?true:false):false);
      $record->min_max_stock = (array_key_exists('min_max_stock', $data)?(($data['min_max_stock'] == 'on')?true:false):false);
      $record->min_notification = (array_key_exists('min_notification', $data)?(($data['min_notification'] == 'on')?true:false):false);

      $record->save();

    }
}
