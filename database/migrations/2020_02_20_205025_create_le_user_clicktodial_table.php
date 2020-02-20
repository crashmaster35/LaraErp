<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeUserClicktodialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('le_user_clicktodial', function (Blueprint $table) {
            $table->bigIncrements('rowid');
            $table->string('url')->nullable();
            $table->string('login', 32)->nullable();
            $table->string('pass', 64)->nullable();
            $table->string('poste', 20)->nullable();
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
        Schema::dropIfExists('le_user_clicktodial');
    }
}
