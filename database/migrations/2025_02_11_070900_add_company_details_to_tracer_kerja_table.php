<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tbl_tracer_kerja', function (Blueprint $table) {
            // Tambahkan kolom baru setelah kolom yang sudah ada
            $table->string('jenis_perusahaan')->after('tracer_kerja_nama');
        });
    }

    public function down()
    {
        Schema::table('tbl_tracer_kerja', function (Blueprint $table) {
            $table->dropColumn(['jenis_perusahaan', 'bentuk_lembaga']);
        });
    }
};