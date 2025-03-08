<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            // Breadcrumb images for pages
            $table->string('breadcrumb_image')->nullable();

            $table->string('site_name');
            $table->string('site_tagline')->nullable();
            $table->string('contact_email');
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->text('country')->nullable();
            $table->string('timezone')->default('UTC');
            $table->string('currency')->default('USD');
            $table->json('social_links')->nullable();
            $table->string('business_hours')->nullable();
            $table->string('site_language')->default('en');

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
        Schema::dropIfExists('site_settings');
    }
}
