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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_name');
            $table->string('promotion_code')->unique();
            $table->integer('stock')->default(1);
            $table->enum('discount_type', ['Percentage', 'Price'])->default('Price');
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->date('start_date')->default(now());
            $table->date('expired_date')->default(now()->addDays(7));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
