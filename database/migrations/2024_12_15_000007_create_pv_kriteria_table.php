<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel pv_kriteria - menyimpan nilai Priority Vector untuk setiap kriteria.
     * Primary key menggunakan id_kriteria (one-to-one dengan tabel kriteria).
     */
    public function up(): void
    {
        Schema::create('pv_kriteria', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kriteria')->primary();
            $table->float('nilai');
            $table->timestamps();

            $table->foreign('id_kriteria')->references('id')->on('kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pv_kriteria');
    }
};
