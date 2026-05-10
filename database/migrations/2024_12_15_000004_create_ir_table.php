<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ir (Index Random) - menyimpan nilai IR untuk perhitungan
     * Consistency Ratio dalam metode AHP.
     * Primary key = jumlah (jumlah kriteria), bukan auto-increment.
     */
    public function up(): void
    {
        Schema::create('ir', function (Blueprint $table) {
            $table->unsignedInteger('jumlah')->primary();
            $table->float('nilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ir');
    }
};
