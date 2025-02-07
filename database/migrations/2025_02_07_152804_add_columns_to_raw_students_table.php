<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_raw_students', function (Blueprint $table) {
            $table->date('tgl_lahir')->nullable()->after('nama_belakang');
            $table->string('tempat_lahir', 50)->nullable()->after('nama_belakang');
            $table->text('alamat')->nullable()->after('tgl_lahir');
        });
    }

    public function down()
    {
        Schema::table('tbl_raw_students', function (Blueprint $table) {
            $table->dropColumn(['tempat_lahir', 'tgl_lahir', 'alamat']);
        });
    }
};