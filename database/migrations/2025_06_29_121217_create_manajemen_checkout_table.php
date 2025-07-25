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
        Schema::create('manajemen_checkout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_checkout')->constrained('checkout')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['Menunggu', 'Diproses', 'Dibatalkan', 'Dikirim', 'Selesai'])->default('Menunggu');
            $table->timestamp('tanggal_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manajemen_checkout');
    }
};
