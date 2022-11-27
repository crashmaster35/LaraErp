<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->after('length', function ($table) {
                $table->enum('period', ['SEMESTRE', 'TETRAMESTRE', 'TRIMESTRE'])->default('TRIMESTRE'); // Time period assigned this class
                $table->integer('total_period')->default(1); // total of periods on the course
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['period', 'total_period']);
        });
    }
}
