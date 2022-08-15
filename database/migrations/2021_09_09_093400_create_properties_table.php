<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type')->default(1);
            $table->integer('admin_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('property_type_id')->default(0);
            $table->integer('city_id')->default(0);
            $table->integer('listing_package_id')->default(0);
            $table->integer('property_purpose_id')->default(0);
            $table->text('title');
            $table->text('slug');
            $table->integer('views')->default(0);
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('website')->nullable();
            $table->text('short_description');
            $table->text('description');
            $table->text('file')->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->text('banner_image')->nullable();
            $table->integer('number_of_unit')->nullable();
            $table->integer('number_of_room')->nullable();
            $table->integer('number_of_bedroom')->nullable();
            $table->integer('number_of_bathroom')->nullable();
            $table->integer('number_of_floor')->nullable();
            $table->integer('number_of_kitchen')->nullable();
            $table->integer('number_of_parking')->nullable();
            $table->double('area')->nullable();
            $table->double('price')->nullable();
            $table->text('period')->nullable();
            $table->text('video_link')->nullable();
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('verified')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
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
        Schema::dropIfExists('properties');
    }
}
