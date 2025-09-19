// database/migrations/YYYY_MM_DD_HHMMSS_create_products_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->primary()->autoIncrement();
            $table->string('nama_produk', 150);
            $table->text('deskripsi');
            $table->decimal('harga', 12, 2);
            $table->unsignedInteger('stok');
            $table->unsignedBigInteger('kategori_id');
            $table->string('gambar_url', 255);
            $table->unsignedBigInteger('user_id')->nullable(); // Untuk menandai produk milik seller
            $table->timestamps();

            $table->foreign('kategori_id')->references('kategori_id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}