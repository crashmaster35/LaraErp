<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('matricula', 12)->nullable();  //220101-? Generacion Carrra Plantel Consecutivo
            $table->string('nombres', 50);
            $table->string('ap_paterno', 25);
            $table->string('ap_materno', 25);
            $table->date('fecha_nac');
            $table->string('lugar_nac', 25);
            $table->integer('anos_cumplidos');
            $table->text('direccion');
            $table->string('ciudad', 50);
            $table->string('email', 50)->nullable();
            $table->string('celular', 25)->nullable();
            $table->string('tel_casa', 25)->nullable();
            $table->enum('nacionalidad', ['MEXICANA', 'EXTRANGERA']);
            $table->string('nacionalidad_ext', 25)->nullable();
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->integer('talla_pantalon')->nullable();
            $table->enum('talla_playera', ['CHICO', 'MEDIANO', 'GRANDE', 'EXTRA GRANDE'])->default('MEDIANO');
            $table->string('secundaria', 50)->nullable(); // Secundaria terminada Nombre de la secundaria donde curso.
            $table->text('secu_dir')->nullable(); // Direccion y telefono de la secundaria de la que procede
            $table->string('preparatoria', 50)->nullable(); // Preparatoria terminada Nombre de la preparatoria donde curso.
            $table->text('prepa_dir')->nullable(); // Direccion y telefono de la prepa de la que procede
            $table->string('universidad', 50)->nullable(); // Ultima universidad terminada Nombre de la universidad donde curso.
            $table->text('uni_dir')->nullable(); // Direccion y telefono de la universidad de la que procede
            $table->text('licenciatura')->nullable(); // En caso de tenerla escriba las licenciaturas que ha cursado.
            $table->string('nombre_rep')->nullable();; // Nombres y apellidos del padre/madre o tutor
            $table->string('ident', 100)->nullable(); // Numero de IFE de identificacion del padre/madre o tutor en caso de menor de edad
            $table->enum('parentesco', ['PADRE', 'MADRE', 'ABUELO', 'ABUELA', 'SIN PARENTESCO', 'OTRO PARENTESCO']);
            $table->enum('estudio_economico', ['MUY BUENA', 'BUENA', 'REGULAR', 'MALA']);
            $table->enum('vivienda', ['PROPIA', 'RENTADA', 'PRESTADA']);
            $table->enum('ocup_rep', ['EMPLEADO PUBLICO', 'EMPLEADO PRIVADO', 'AUTONOMO', 'JUBILADO', 'NO TRABAJA']);
            $table->enum('estudios_rep', ['ANALFABETO', 'CURSOS EXTRAESCOLARES', 'PRIMARIA INCOMPLETA', 'PRIMARIA COMPLETA', 'SECUNDARIA INCOMPLETA', 'SECUNDARIA COMPLETA', 'PREPARATORIA INCOMPLETA', 'PREPARATORIA COMPLETA', 'UNIVERSIDAD INCOMPLETA', 'UNIVERSIDAD COMPLETA', 'POSGRADO INCOMPLETO', 'POSGRADO COMPLETO']);
            $table->boolean('activo')->default(0);
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
        Schema::dropIfExists('students');
    }
}
