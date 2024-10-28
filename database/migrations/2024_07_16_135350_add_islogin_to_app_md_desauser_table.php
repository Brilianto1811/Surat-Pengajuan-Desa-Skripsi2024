<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsloginToAppMdDesauserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_md_desauser', function (Blueprint $table) {
            $table->boolean('islogin')->default(false)->after('flag_del');
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
            $table->dropColumn('islogin');
        });
    }
}
