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
        Schema::create('detail_checkout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_produk')->constrained('produk');
            $table->foreignId('id_checkout')->constrained('checkout');
            $table->integer('qty')->default(1);
            $table->decimal('harga_satuan', 8, 0)->default(0.0);
            $table->decimal('harga_subtotal', 9, 0)->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_checkout');
    }
};
