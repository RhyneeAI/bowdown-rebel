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
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_ekspedisi')->constrained('ekspedisi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('no_faktur', 22)->unique();
            $table->decimal('total_harga', 9, 2)->default(0.00);
            $table->decimal('diskon', 9, 2)->default(0.00);
            $table->decimal('dibayar', 9, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout');
    }
};
