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
        Schema::create('varian_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ukuran', 5);
            $table->decimal('harga', 8, 0)->default(0.0);
            $table->integer('stok')->default(0);
            $table->integer('min_stok')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varian_produk');
    }
};
