<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyIsloginToStringInAppMdDesauserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_md_desauser', function (Blueprint $table) {
            $table->string('islogin')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_md_desauser', function (Blueprint $table) {
            $table->boolean('islogin')->nullable(false)->default(false)->change();
        });
    }
}
