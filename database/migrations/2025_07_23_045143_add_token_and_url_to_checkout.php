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
        Schema::table('checkout', function (Blueprint $table) {
            $table->string('token')->nullable()->after('no_faktur');
            $table->string('url_payment')->nullable()->after('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('checkout', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('url_payment');
        });
    }
};
