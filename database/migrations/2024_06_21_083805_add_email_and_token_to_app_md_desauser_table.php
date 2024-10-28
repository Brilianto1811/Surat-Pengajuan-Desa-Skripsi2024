<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('app_md_desauser', function (Blueprint $table) {
            $table->string('email_desauser')->nullable();
            $table->string('token_desauser')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_md_desauser', function (Blueprint $table) {
            //
        });
    }
};
