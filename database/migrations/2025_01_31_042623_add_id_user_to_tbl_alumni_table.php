<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_alumni', function (Blueprint $table) {
            $table->foreignId('id_user')->nullable()->after('id_alumni');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('tbl_alumni', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
    }
};