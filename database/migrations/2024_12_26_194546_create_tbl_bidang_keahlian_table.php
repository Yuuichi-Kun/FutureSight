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
        Schema::create('tbl_bidang_keahlian', function (Blueprint $table) {
            $table->id('id_bidang_keahlian');
            $table->string('kode_bidang_keahlian', 10)->unique();
            $table->string('bidang_keahlian', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_bidang_keahlian');
    }
};
