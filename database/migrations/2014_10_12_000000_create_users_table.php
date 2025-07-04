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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 16)->unique();
            $table->string('nama', 150);
            $table->date('tanggal_lahir');
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->foreignId('id_role')->constrained('role')->onUpdate('cascade')->onDelete('cascade');
            $table->string('foto', 40)->nullable();
            $table->string('username');
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
