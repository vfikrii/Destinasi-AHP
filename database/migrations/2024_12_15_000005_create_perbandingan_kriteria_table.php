<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel perbandingan_kriteria - menyimpan nilai perbandingan berpasangan
     * antar kriteria dalam metode AHP.
     * kriteria1 & kriteria2 merujuk ke tabel kriteria.
     */
    public function up(): void
    {
        Schema::create('perbandingan_kriteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kriteria1');
            $table->unsignedBigInteger('kriteria2');
            $table->float('nilai');
            $table->timestamps();

            $table->foreign('kriteria1')->references('id')->on('kriteria')->onDelete('cascade');
            $table->foreign('kriteria2')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_kriteria');
    }
};
