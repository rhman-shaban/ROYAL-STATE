<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_mode')->nullable();
            $table->text('paypal_client_id')->nullable();
            $table->text('paypal_secret')->nullable();
            $table->text('stripe_key')->nullable();
            $table->text('stripe_secret')->nullable();
            $table->text('captcha_key')->nullable();
            $table->text('captcha_secret')->nullable();
            $table->text('bank_account')->nullable();
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
        Schema::dropIfExists('payment_accounts');
    }
}
