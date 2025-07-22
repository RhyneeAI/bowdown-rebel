<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Non Aktif'])->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->default('Aktif')->change();
        });
    }

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->string('status')->default('Aktif')->change();
        });
    }
};