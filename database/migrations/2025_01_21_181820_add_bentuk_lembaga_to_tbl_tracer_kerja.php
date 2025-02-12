<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tbl_tracer_kerja', function (Blueprint $table) {
            $table->enum('bentuk_lembaga', ['PT', 'CV', 'Firma', 'Perseorangan']);
        });
    }

    public function down()
    {
        Schema::table('tbl_tracer_kerja', function (Blueprint $table) {
            $table->dropColumn('bentuk_lembaga');
        });
    }
};