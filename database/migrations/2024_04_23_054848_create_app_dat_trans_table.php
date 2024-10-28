<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppDatTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_dat_trans', function (Blueprint $table) {
            $table->increments('id_trans');
            $table->string('id_kec')->nullable();
            $table->string('id_kel')->nullable();
            $table->dateTime('tgl_trans')->nullable();
            $table->string('nik_trans_req')->nullable();
            $table->string('nik_trans_srt')->nullable();
            $table->string('id_surat')->nullable();
            $table->string('note_req')->nullable();
            $table->string('comt_trans')->nullable();
            $table->dateTime('tgl_mulai')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->string('no_surat')->nullable();
            $table->dateTime('tgl_surat')->nullable();
            $table->string('str_ttd')->nullable();
            $table->string('str_wni')->nullable();
            $table->string('id_status')->nullable();
            $table->string('note_status')->nullable();
            $table->string('nama_warga')->nullable();
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
        Schema::dropIfExists('app_dat_trans');
    }
}
