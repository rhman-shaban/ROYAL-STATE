<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name')->nullable();
            $table->string('package_type')->nullable();
            $table->integer('price')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->integer('number_of_aminities')->nullable();
            $table->integer('number_of_nearest_place')->nullable();
            $table->integer('number_of_photo')->nullable();
            $table->integer('number_of_property')->nullable();
            $table->integer('number_of_feature_property')->nullable();
            $table->integer('number_of_top_property')->nullable();
            $table->integer('number_of_urgent_property')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_top')->default(0);
            $table->tinyInteger('is_urgent')->default(0);
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
        Schema::dropIfExists('packages');
    }
}
