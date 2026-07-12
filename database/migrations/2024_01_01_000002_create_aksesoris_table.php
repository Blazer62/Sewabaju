<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aksesoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baju_id')->constrained('bajus')->onDelete('cascade');
            $table->string('nama');
            $table->decimal('harga', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aksesoris');
    }
};
