<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeUserEmploymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('le_user_employment', function (Blueprint $table) {
            $table->bigIncrements('rowid');
            $table->integer('entity')->default(1);
            $table->string('ref', 50)->nullable();
            $table->string('ref_ext', 50)->nullable();
            $table->integer('fk_user')->nullable();
            $table->dateTime('datec')->nullable();
            $table->timestamp('tms');
            $table->integer('fk_user_creat')->nullable();
            $table->integer('fk_user_modif')->nullable();
            $table->string('job', 128)->nullable();
            $table->integer('status');
            $table->double('salary', 24, 8)->nullable();
            $table->double('salaryextra', 24, 8)->nullable();
            $table->double('weeklyhours', 16, 8)->nullable();
            $table->date('dateemployment')->nullable();
            $table->date('dateemploymentend')->nullable();
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
        Schema::dropIfExists('le_user_employment');
    }
}
