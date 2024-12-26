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
        Schema::create('tbl_program_keahlian', function (Blueprint $table) {
            $table->id('id_program_keahlian');
            $table->foreignId('id_bidang_keahlian')->constrained('tbl_bidang_keahlian', 'id_bidang_keahlian')->cascadeOnDelete();
            $table->string('kode_program_keahlian', 10)->unique();
            $table->string('program_keahlian', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_program_keahlian');
    }
};
