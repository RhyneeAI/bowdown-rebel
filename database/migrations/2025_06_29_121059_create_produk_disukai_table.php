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
        Schema::create('produk_disukai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_disukai');
    }
};
