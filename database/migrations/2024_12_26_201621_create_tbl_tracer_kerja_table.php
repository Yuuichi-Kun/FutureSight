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
        Schema::create('tbl_tracer_kerja', function (Blueprint $table) {
            $table->id('id_tracer_kerja');
            $table->foreignId('id_alumni')->constrained('tbl_alumni', 'id_alumni')->cascadeOnDelete();
            $table->string('tracer_kerja_pekerjaan', 50);
            $table->string('tracer_kerja_nama', 50);
            $table->string('tracer_kerja_jabatan', 50);
            $table->string('tracer_kerja_status', 50);
            $table->string('tracer_kerja_lokasi', 50);
            $table->string('tracer_kerja_alamat', 50);
            $table->date('tracer_kerja_tgl_mulai');
            $table->string('tracer_kerja_gaji', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_tracer_kerja');
    }
};
