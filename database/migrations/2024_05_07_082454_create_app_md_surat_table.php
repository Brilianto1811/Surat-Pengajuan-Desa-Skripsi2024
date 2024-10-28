<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreateAppMdSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_surat', function (Blueprint $table) {
            $table->increments('id_surat');
            $table->bigInteger('id_suratcat')->nullable();
            $table->bigInteger('id_datasurat')->nullable();
            $table->bigInteger('id_kec')->nullable();
            $table->bigInteger('id_kel')->nullable();
            $table->string('name_surat')->nullable();
            $table->string('nama_kec')->nullable();
            $table->string('nama_des')->nullable();
            $table->string('alamat_des')->nullable();
            $table->string('judul_surat')->nullable();
            $table->string('format_nomor_surat')->nullable();
            $table->string('nama')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->dateTime('tanggal_lahir')->nullable();
            $table->string('usia')->nullable();
            $table->string('sex')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('no_kk')->nullable();
            $table->string('kepala_kk')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('agama')->nullable();
            $table->string('status')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('warga_negara')->nullable();
            $table->dateTime('mulai_berlaku')->nullable();
            $table->dateTime('tgl_akhir')->nullable();
            $table->string('form_tujuan')->nullable();
            $table->string('form_keterangan')->nullable();
            $table->dateTime('form_berlaku_dari')->nullable();
            $table->dateTime('form_berlaku_sampai')->nullable();
            $table->string('form_kecamatan_kua')->nullable();
            $table->dateTime('form_tgl_nikah')->nullable();
            $table->string('form_nama_pasangan')->nullable();
            $table->string('form_jenis_keramaian')->nullable();
            $table->string('form_keperluan')->nullable();
            $table->string('form_no_jamkesos')->nullable();
            $table->string('form_usaha')->nullable();
            $table->string('keperluan')->nullable();
            $table->string('gol_darah')->nullable();
            $table->string('sebutan_desa')->nullable();
            $table->string('nama_kecamatan')->nullable();
            $table->string('nama_kabupaten')->nullable();
            $table->dateTime('tgl_surat')->nullable();
            $table->string('penandatangan')->nullable();
            $table->string('nama_pejabat')->nullable();
            $table->string('id_status')->nullable();
            $table->string('note_status')->nullable();
            $table->string('uid')->nullable();
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
        Schema::dropIfExists('app_md_surat');
    }
}
