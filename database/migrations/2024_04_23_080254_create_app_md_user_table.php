<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMdUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_user', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('name_user')->nullable();
            $table->string('gelar_dpn')->nullable();
            $table->string('gelar_blk')->nullable();
            $table->string('login_user')->nullable();
            $table->string('pswd')->nullable();
            $table->string('level_user')->nullable();
            $table->string('id_company')->nullable();
            $table->string('id_branch')->nullable();
            $table->string('nip_user')->nullable();
            $table->string('id_golongan')->nullable();
            $table->string('telp_user')->nullable();
            $table->string('email_user')->nullable();
            $table->string('id_jabatan')->nullable();
            $table->string('id_instansi')->nullable();
            $table->string('id_bidang')->nullable();
            $table->string('id_bidangsub')->nullable();
            $table->string('comt_user')->nullable();
            $table->string('flag_del')->nullable();
            $table->string('islogin')->nullable();
            $table->string('dispmode')->nullable();
            $table->string('filter1')->nullable();
            $table->string('filter2')->nullable();
            $table->string('filter3')->nullable();
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
        Schema::dropIfExists('app_md_user');
    }
}
