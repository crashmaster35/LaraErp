<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_configs', function (Blueprint $table) {
            $table->id();
            $table->boolean('decrement_stock_clients')->default(true);
            $table->boolean('increment_stock_providers')->default(true);
            $table->boolean('negative_stock')->default(false);
            $table->boolean('positive_stock')->default(true);
            $table->boolean('min_max_stock')->default(false);
            $table->boolean('min_notification')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_configs');
    }
}
