<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMdKelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_kel', function (Blueprint $table) {
            $table->increments('id_kel');
            $table->string('id_kec')->nullable();
            $table->string('name_kel')->nullable();
            $table->string('code_kel')->nullable();
            $table->string('comt_kel')->nullable();
            $table->dateTime('tgl_data')->nullable();
            $table->string('id_user')->nullable();
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
        Schema::dropIfExists('app_md_kel');
    }
}
