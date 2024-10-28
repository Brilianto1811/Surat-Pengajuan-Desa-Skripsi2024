<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMdDesauserstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_desauserstatus', function (Blueprint $table) {
            $table->increments('id_desauserstatus');
            $table->string('name_desauserstatus')->nullable();
            $table->string('comt_desauserstatus')->nullable();
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
        Schema::dropIfExists('app_md_desauserstatus');
    }
}
