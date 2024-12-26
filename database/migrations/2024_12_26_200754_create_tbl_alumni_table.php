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
        Schema::create('tbl_alumni', function (Blueprint $table) {
            $table->id('id_alumni');
            $table->foreignId('id_tahun_lulus')->constrained('tbl_tahun_lulus', 'id_tahun_lulus')->cascadeOnDelete();
            $table->foreignId('id_konsentrasi_keahlian')->constrained('tbl_konsentrasi_keahlian', 'id_konsentrasi_keahlian')->cascadeOnDelete();
            $table->foreignId('id_status_alumni')->constrained('tbl_status_alumni', 'id_status_alumni')->cascadeOnDelete();
            $table->string('nisn', 20)->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('nama_depan', 50);
            $table->string('nama_belakang', 50);
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 20);
            $table->date('tgl_lahir');
            $table->string('alamat', 50);
            $table->string('no_hp', 15)->nullable();
            $table->string('akun_fb', 50)->nullable();
            $table->string('akun_ig', 50)->nullable();
            $table->string('akun_tiktok', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->longText('password');
            $table->enum('status_login', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_alumni');
    }
};
