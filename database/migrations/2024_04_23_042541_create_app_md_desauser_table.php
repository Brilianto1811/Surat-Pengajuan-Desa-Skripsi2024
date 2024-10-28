<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMdDesauserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_desauser', function (Blueprint $table) {
            $table->increments('id_desauser');
            $table->string('id_kec')->nullable();
            $table->string('id_kel')->nullable();
            $table->string('mode_desauser')->nullable();
            $table->string('name_desauser')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_pass')->nullable();
            $table->string('str_pswd_hsh')->nullable();
            $table->string('str_foto')->nullable();
            $table->string('id_desausertype')->nullable();
            $table->string('id_desauserstatus')->nullable();
            $table->string('nik_desauser')->nullable();
            $table->string('nohp_desauser')->nullable();
            $table->string('id_user')->nullable();
            $table->dateTime('tgl_data')->nullable();
            $table->string('flag_del')->nullable();
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
        Schema::dropIfExists('app_md_desauser');
    }
}
