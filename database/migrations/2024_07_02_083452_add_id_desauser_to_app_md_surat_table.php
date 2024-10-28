<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDesauserToAppMdSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_md_surat', function (Blueprint $table) {
            $table->bigInteger('id_desauser')->nullable()->after('id_kel'); // Tentukan posisi kolom baru jika diperlukan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_md_surat', function (Blueprint $table) {
            $table->dropColumn('id_desauser');
        });
    }
}
