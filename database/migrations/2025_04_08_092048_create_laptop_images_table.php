<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaptopImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laptop_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laptop_id');
            
            $table->string('image'); // Path to the image
            $table->timestamps();

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
        Schema::dropIfExists('laptop_images');
    }
}
