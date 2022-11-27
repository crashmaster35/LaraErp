<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->text('name', 50); // name of the class
            $table->bigInteger('course_id')->unsigned(); // wich course will have this class
            $table->integer('hours'); // number of hours assigned to the class
            $table->enum('period', ['SEMESTRE', 'TETRAMESTRE', 'TRIMESTRE'])->default('TRIMESTRE'); // Time period assigned this class
            $table->integer('what_period')->default(1); // time period for example 3 trimestre. In wich period will be course this class
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
        Schema::dropIfExists('class');
    }
}
