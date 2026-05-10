<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guest_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('alternatif_id')->constrained('alternatif')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->integer('rating_bintang'); // 1-5
            $table->timestamps();
            
            $table->unique(['user_id', 'alternatif_id', 'kriteria_id'], 'guest_rating_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_ratings');
    }
};
