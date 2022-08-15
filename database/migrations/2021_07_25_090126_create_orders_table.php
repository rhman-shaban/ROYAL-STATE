<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('listing_package_id');
            $table->date('purchase_date');
            $table->integer('expired_day');
            $table->date('expired_date')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('transaction_id')->nullable();
            $table->tinyInteger('payment_status')->default(0);
            $table->float('amount')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
