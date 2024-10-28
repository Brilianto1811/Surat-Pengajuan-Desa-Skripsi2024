<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreateAppMdDesaprofileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_desaprofile', function (Blueprint $table) {
            $table->increments('id_desaprofile');
            $table->bigInteger('id_kec')->nullable();
            $table->bigInteger('id_kel')->nullable();
            $table->string('comt_webdesa')->nullable();
            $table->string('nama_kades')->nullable();
            $table->string('desa_addr')->nullable();
            $table->string('url_web')->nullable();
            $table->string('desa_mail')->nullable();
            $table->string('sosial_media')->nullable();
            $table->string('nomor_kontak')->nullable();
            $table->string('state_desa')->nullable();
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
        Schema::dropIfExists('app_md_desaprofile');
    }
}
