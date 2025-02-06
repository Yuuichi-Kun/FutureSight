<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tbl_raw_students', function (Blueprint $table) {
            $table->id('id_raw_student');
            $table->string('nisn', 20)->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('nama_depan', 50);
            $table->string('nama_belakang', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbl_raw_students');
    }
};