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
            $table->bigInteger('student_id');
            $table->enum('type', ['INSCRIPCION', 'MENSUALIDAD', 'EXAMEN EXTRAORDINARIO', 'BLS', 'PHTLS', 'IPR', 'OTROS'])->default('MENSUALIDAD');
            $table->double('amount',2,2);
            $table->text('notes')->nullable();
            $table->text('bank', 100);
            $table->string('transaction', 100)->nullable();
            $table->date('transaction_date');
            $table->time('transaction_time');
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
