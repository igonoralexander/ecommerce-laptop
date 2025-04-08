<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClientBookingFieldsToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('location')->nullable();
            $table->text('special_requests')->nullable();
            $table->integer('num_people')->nullable();
            $table->enum('payment_status', ['pending', 'deposit_paid', 'fully_paid'])->default('pending');
            $table->decimal('amount_paid', 10, 2)->nullable();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
