<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreateAppMdStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_status', function (Blueprint $table) {
            $table->increments('id_status');
            $table->string('name_status')->nullable();
            $table->string('comt_status')->nullable();
            $table->string('flag_del')->nullable();
            $table->string('id_user')->nullable();
            $table->string('tgl_data')->nullable();
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
        Schema::dropIfExists('app_md_status');
    }
}
