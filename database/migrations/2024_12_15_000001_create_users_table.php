<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel users - menyimpan data pengguna (admin & guest).
     * Kolom password menyimpan hash MD5 (dari sistem lama).
     * Kolom role menggunakan enum: 'admin' atau 'guest' (default: 'guest').
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('email', 100)->nullable();
            $table->enum('role', ['admin', 'guest'])->default('guest');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
