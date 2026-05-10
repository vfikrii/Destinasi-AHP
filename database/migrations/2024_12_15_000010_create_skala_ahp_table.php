<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skala_ahp', function (Blueprint $table) {
            $table->id();
            $table->string('nama_skala', 50); // ex: Sangat Baik
            $table->integer('bintang'); // 1-5
            $table->double('nilai_ahp', 10, 6); // ex: 9
            $table->timestamps();
            
            $table->unique('bintang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skala_ahp');
    }
};
