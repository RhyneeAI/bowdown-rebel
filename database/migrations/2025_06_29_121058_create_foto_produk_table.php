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
        Schema::create('foto_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_asli', 150);
            $table->string('nama_hash', 40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_produk');
    }
};
