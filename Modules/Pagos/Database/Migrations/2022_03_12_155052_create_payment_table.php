<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('group_id')->unsigned()->nullable();
            $table->integer('number')->unsigned()->nullable();
            $table->enum('type', ['INSCRIPCION', 'MENSUALIDAD', 'EXAMEN EXTRAORDINARIO', 'BLS', 'PHTLS', 'IPR', 'OTROS'])->default('MENSUALIDAD');
            $table->double('amount');
            $table->text('notes')->nullable();
            $table->text('bank', 100)->nullable();
            $table->string('transaction')->nullable();
            $table->date('transaction_date')->nullable();
            $table->time('transaction_time')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
