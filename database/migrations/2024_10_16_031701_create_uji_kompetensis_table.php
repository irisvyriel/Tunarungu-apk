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
        Schema::create('uji_kompetensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bab_id')->constrained();
            $table->string('soal');
            $table->enum('tipe', ['Pilihan Ganda', 'Essay']);
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('uji_kompetensis');
    }
};
