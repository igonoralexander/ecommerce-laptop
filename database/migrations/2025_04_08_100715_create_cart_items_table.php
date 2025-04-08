<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('cart_id'); // Who made the booking (photographer or client)
            $table->unsignedBigInteger('laptop_id');

            $table->integer('quantity'); // Quantity of the laptop in the cart
            $table->decimal('price_at_time', 10, 2); // Price of the laptop at the time it was added to the cart
            $table->timestamps();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
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
        Schema::dropIfExists('cart_items');
    }
}
