<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('order_id'); // Who made the booking (photographer or client)
            $table->unsignedBigInteger('laptop_id');

            $table->integer('quantity'); // Number of laptops in this order item
            $table->decimal('price', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('laptop_id')->references('id')->on('laptops')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
