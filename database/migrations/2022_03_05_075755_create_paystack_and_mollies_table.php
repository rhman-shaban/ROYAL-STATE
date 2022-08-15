<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaystackAndMolliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paystack_and_mollies', function (Blueprint $table) {
            $table->id();
            $table->string('mollie_key');
            $table->integer('mollie_status')->default(0);
            $table->double('mollie_currency_rate')->default(1);
            $table->string('mollie_country_code')->nullable();
            $table->string('mollie_currency_code')->default(0);
            $table->string('paystack_public_key')->nullable();
            $table->string('paystack_secret_key')->nullable();
            $table->double('paystack_currency_rate')->default(1);
            $table->integer('paystack_country_code')->nullable();
            $table->integer('paystack_currency_code')->nullable();
            $table->integer('paystack_status')->default(0);
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
        Schema::dropIfExists('paystack_and_mollies');
    }
}
