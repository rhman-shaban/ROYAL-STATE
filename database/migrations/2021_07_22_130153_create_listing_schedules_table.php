<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('listing_id');
            $table->integer('day_id');
            $table->tinyInteger('is_open')->default(0);
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('listing_schedules');
    }
}
