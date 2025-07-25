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
        Schema::create('promosi_dipakai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_promosi')->constrained('promosi');
            $table->foreignId('id_user')->constrained('user');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosi_dipakai');
    }
};
