<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            
            $table->string('name'); // Name of the laptop
            $table->text('description'); // Description of the laptop
            $table->text('specifications'); // Detailed specifications of the laptop
            $table->decimal('price', 10, 2); // Price of the laptop
            $table->integer('stock_quantity'); // Number of units in stock
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laptops');
    }
}
