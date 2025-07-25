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
        Schema::table('detail_checkout', function (Blueprint $table) {
            $table->foreignId('id_variant_produk')->nullable()->after('id_produk')->constrained('varian_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_checkout', function (Blueprint $table) {
            $table->dropColumn('id_variant_produk');
        });
    }
};
