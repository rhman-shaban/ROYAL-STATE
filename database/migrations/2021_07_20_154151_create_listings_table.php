<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type')->default(1);
            $table->integer('admin_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('listing_category_id')->default(0);
            $table->integer('location_id')->default(0);
            $table->integer('listing_package_id')->default(0);
            $table->text('title');
            $table->text('slug');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('views')->default(0);
            $table->text('address')->nullable();
            $table->text('phone')->nullable();
            $table->text('email')->nullable();
            $table->text('website')->nullable();
            $table->text('sort_description');
            $table->text('description');
            $table->text('logo')->nullable();
            $table->text('file')->nullable();
            $table->text('thumbnail_image')->nullable();
            $table->text('banner_image')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('instagram')->nullable();
            $table->text('pinterest')->nullable();
            $table->text('tumblr')->nullable();
            $table->text('youtube')->nullable();
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
        Schema::dropIfExists('listings');
    }
}
