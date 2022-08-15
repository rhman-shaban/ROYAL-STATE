<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRazorpaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razorpays', function (Blueprint $table) {
            $table->id();
            $table->string('razorpay_key');
            $table->string('secret_key');
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->string('theme_color');
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
        Schema::dropIfExists('razorpays');
    }
}
