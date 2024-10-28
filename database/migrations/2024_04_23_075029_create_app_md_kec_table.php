<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMdKecTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_kec', function (Blueprint $table) {
            $table->increments('id_kec');
            $table->string('id_kab')->nullable();
            $table->string('name_kab')->nullable();
            $table->string('code_kec')->nullable();
            $table->string('id_user')->nullable();
            $table->dateTime('tgl_data')->nullable();
            $table->string('flag_del')->nullable();
            $table->string('name_upt')->nullable();
            $table->string('cibraya')->nullable();
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
        Schema::dropIfExists('app_md_kec');
    }
}
