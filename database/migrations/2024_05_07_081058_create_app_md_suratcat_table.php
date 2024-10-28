<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// return new class extends Migration
class CreateAppMdSuratcatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_md_suratcat', function (Blueprint $table) {
            $table->increments('id_suratcat');
            $table->string('code_suratcat')->nullable();
            $table->string('name_suratcat')->nullable();
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
        Schema::dropIfExists('app_md_suratcat');
    }
}
