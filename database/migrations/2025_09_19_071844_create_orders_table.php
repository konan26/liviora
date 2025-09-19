// database/migrations/YYYY_MM_DD_HHMMSS_create_orders_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->primary()->autoIncrement();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('tanggal_order')->useCurrent();
            $table->enum('status_order', ['pending', 'paid', 'shipped', 'done', 'cancelled'])->default('pending');
            $table->decimal('total_harga', 12, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}