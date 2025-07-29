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
        Schema::table('promosi', function (Blueprint $table) {
            $table->decimal('minimum_pembelian', 8, 0)->default(0.0)->after('diskon_harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promosi', function (Blueprint $table) {
            $table->dropColumn('minimum_pembelian');
        });
    }
};
