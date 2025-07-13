<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->index('slug', 'idx_slug');
        });

        Schema::table('produk', function (Blueprint $table) {
            $table->index(['unggulan', 'status'], 'idx_unggulan_status');
            $table->index('slug', 'idx_slug');
            $table->index('id_kategori', 'idx_kategori');
            $table->index(['id', 'id_kategor,i', 'nama_produk', 'slug', 'unggulan', 'status'], 'idx_shop');
        });

        Schema::table('varian_produk', function (Blueprint $table) {
            $table->index(['id_produk', 'harga'], 'idx_harga_produk');
        });

        Schema::table('foto_produk', function (Blueprint $table) {
            $table->index('id_produk', 'idx_produk');
        });

        Schema::table('produk_disukai', function (Blueprint $table) {
            $table->index(['id_produk', 'created_at'], 'idx_like_sort');
        });

        Schema::table('keranjang', function (Blueprint $table) {
            $table->index('id_user', 'idx_user');
        });

        Schema::table('keranjang_item', function (Blueprint $table) {
            $table->index('id_keranjang', 'idx_keranjang');
            $table->index('id_produk', 'idx_produk');
        });

        Schema::table('checkout', function (Blueprint $table) {
            $table->index('id_user', 'idx_user');
        });

        Schema::table('detail_checkout', function (Blueprint $table) {
            $table->index('id_checkout', 'idx_checkout');
            $table->index('id_produk', 'idx_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropIndex('idx_slug');
        });

        Schema::table('produk', function (Blueprint $table) {
            $table->dropIndex('idx_unggulan_status');
            $table->dropIndex('idx_slug');
            $table->dropIndex('idx_kategori');
            $table->dropIndex('idx_shop');
        });

        Schema::table('varian_produk', function (Blueprint $table) {
            $table->dropIndex('idx_harga_produk');
        });

        Schema::table('foto_produk', function (Blueprint $table) {
            $table->dropIndex('idx_produk');
        });

        Schema::table('produk_disukai', function (Blueprint $table) {
            $table->dropIndex('idx_like_sort');
        });

        Schema::table('keranjang', function (Blueprint $table) {
            $table->dropIndex('idx_user');
        });

        Schema::table('keranjang_item', function (Blueprint $table) {
            $table->dropIndex('idx_keranjang');
            $table->dropIndex('idx_produk');
        });

        Schema::table('checkout', function (Blueprint $table) {
            $table->dropIndex('idx_user');
        });

        Schema::table('detail_checkout', function (Blueprint $table) {
            $table->dropIndex('idx_checkout');
            $table->dropIndex('idx_produk');
        });
    }
};