<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreateAppMdDatasuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_datasurat', function (Blueprint $table) {
            $table->increments('id_datasurat');
            $table->bigInteger('id_suratcat')->nullable();
            $table->string('code_surat')->nullable();
            $table->string('name_surat')->nullable();
            $table->string('comt_surat')->nullable();
            $table->string('temp_surat')->nullable();
            $table->string('state_surat')->nullable();
            $table->string('flag_del')->nullable();
            $table->string('id_user')->nullable();
            $table->dateTime('tgl_data')->nullable();
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
        Schema::dropIfExists('app_md_datasurat');
    }
}
