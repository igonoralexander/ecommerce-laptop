<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable;
            $table->unsignedBigInteger('booked_by'); // Who made the booking (photographer or client)
            $table->unsignedBigInteger('package_id');
            $table->string('client_name')->nullable(); // For guests
            $table->string('client_email')->nullable(); // For guests
            $table->string('client_phone')->nullable(); // For guests
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'canceled'])->default('pending');

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('booked_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
