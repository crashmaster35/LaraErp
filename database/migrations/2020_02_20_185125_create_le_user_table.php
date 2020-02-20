<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('le_user', function (Blueprint $table) {
            $table->bigIncrements('rowid');
            $table->integer('entity')->default(1);
            $table->string('ref_ext', 50)->nullable();
            $table->string('ref_int', 50)->nullable();
            $table->tinyInteger('employee')->default(1)->nullable();
            $table->integer('tk_establishment')->default(0)->nullable();
            $table->dateTime('datec')->nullable();
            $table->timestamp('tms');
            $table->integer('fk_user_creat')->nullable();
            $table->integer('fk_user_modif')->nullable();
            $table->string('login', 50);
            $table->string('pass_encoding', 24)->nullable();
            $table->string('pass', 128)->nullable();
            $table->string('pass_crypted', 128)->nullable();
            $table->string('pass_temp', 128)->nullable();
            $table->string('api_key', 128)->nullable()->unique();
            $table->string('gender', 10)->nullable();
            $table->string('civility', 6)->nullable();
            $table->string('lastname', 50)->nullable();
            $table->string('firstname', 50)->nullable();
            $table->string('address')->nullable();
            $table->string('zip', 25)->nullable();
            $table->string('town', 50)->nullable();
            $table->integer('fk_state')->default(0)->nullable();
            $table->integer('fk_country')->default(0)->nullable();
            $table->date('birth')->nullable();
            $table->string('job', 128)->nullable();
            $table->string('office_phone', 20)->nullable();
            $table->string('office_fax', 20)->nullable();
            $table->string('user_mobile', 20)->nullable();
            $table->string('personal_mobile', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('personal_email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->text('socialnetworks')->nullable();
            $table->string('jabberid')->nullable();
            $table->string('stype')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('googleplus')->nullable();
            $table->string('youtube')->nullable();
            $table->string('whatsapp')->nullable();
            $table->text('signature')->nullable();
            $table->smallInteger('admin')->default(0)->nullable();
            $table->smallInteger('module_comm')->default(1)->nullable();
            $table->smallInteger('module_compta')->default(1)->nullable();
            $table->integer('fk_soc')->nullable();
            $table->integer('fk_socpeople')->nullable()->unique();
            $table->integer('fk_member')->nullable()->unique();
            $table->integer('fk_user')->nullable();
            $table->integer('fk_user_expense_validator')->nullable();
            $table->integer('fk_user_holiday_validator')->nullable();
            $table->text('note_public')->nullable();
            $table->text('note')->nullable();
            $table->string('model_pdf')->nullable();
            $table->dateTime('datelastlogin')->nullable();
            $table->dateTime('datepreviouslogin')->nullable();
            $table->integer('egroupware_id')->nullable();
            $table->string('ldap_sid')->nullable();
            $table->string('openid')->nullable();
            $table->tinyInteger('statut')->default(1)->nullable();;
            $table->string('photo')->nullable();
            $table->string('lang', 6)->nullable();
            $table->string('color', 6)->nullable();
            $table->string('barcode')->nullable();
            $table->integer('fk_barcode_type')->default(0)->nullable();;
            $table->string('accountancy_code', 32)->nullable();
            $table->integer('nb_holiday')->default(0)->nullable();;
            $table->double('thm', 24, 8)->nullable();
            $table->double('tjm', 24, 8)->nullable();
            $table->double('salary', 24, 8)->nullable();
            $table->double('salaryextra', 24, 8)->nullable();
            $table->date('dateemployment')->nullable();
            $table->date('dateemploymentend')->nullable();
            $table->double('weeklyhours', 24, 8)->nullable();
            $table->string('import_key', 14)->nullable();
            $table->integer('default_range')->nullable();
            $table->integer('default_c_exp_tax_cat')->nullable();
            $table->integer('fk_warehouse')->nullable();
            $table->string('iplastlogin', 250)->nullable();
            $table->string('ippreviouslogin', 250)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('le_user');
    }
}
