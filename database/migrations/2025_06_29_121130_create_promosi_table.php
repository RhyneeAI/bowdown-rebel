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
        Schema::create('promosi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_promosi', 100);
            $table->string('kode_promosi', 30)->unique();
            $table->integer('stok')->default(1);
            $table->decimal('diskon_harga', 8, 1)->default(0.0);
            $table->date('tanggal_mulai')->default(now());
            $table->date('tanggal_berakhir')->default(now()->addDays(7));
            $table->string('foto', 40)->nullable();
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosi');
    }
};
