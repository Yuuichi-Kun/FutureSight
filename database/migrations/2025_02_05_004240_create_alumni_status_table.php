<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alumni_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_alumni');
            $table->unsignedBigInteger('id_status_alumni');
            $table->timestamps();

            $table->foreign('id_alumni')->references('id_alumni')->on('tbl_alumni')->onDelete('cascade');
            $table->foreign('id_status_alumni')->references('id_status_alumni')->on('tbl_status_alumni')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alumni_status');
    }
};