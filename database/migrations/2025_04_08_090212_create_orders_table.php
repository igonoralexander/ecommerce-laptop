<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('guest_email')->nullable(); // Store guest user's email
            $table->string('guest_name')->nullable(); // Store guest user's name
            $table->text('guest_address')->nullable(); // Store guest user's address
            $table->decimal('total_price', 10, 2); // Total price of the order
            $table->string('status')->default('pending'); // Status of the order (e.g., pending, completed, shipped)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
