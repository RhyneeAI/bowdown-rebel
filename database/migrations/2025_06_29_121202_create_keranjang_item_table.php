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
        Schema::create('keranjang_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_keranjang')->constrained('keranjang')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('qty')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_item');
    }
};
