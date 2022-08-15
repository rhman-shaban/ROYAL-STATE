<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('patient_can_register')->default(1);
            $table->tinyInteger('show')->default(1);
            $table->tinyInteger('save_contact_message')->default(0);
            $table->tinyInteger('comment_type')->default(1);
            $table->text('facebook_comment_script')->nullable();
            $table->tinyInteger('preloader')->default(1);
            $table->string('preloader_image')->nullable();
            $table->tinyInteger('allow_cookie_consent')->default(0);
            $table->text('cookie_text')->nullable();
            $table->string('cookie_button_text')->nullable();
            $table->text('captcha_key')->nullable();
            $table->text('captcha_secret')->nullable();
            $table->tinyInteger('allow_captcha')->default(0);
            $table->tinyInteger('live_chat')->default(0);
            $table->text('livechat_script')->nullable();
            $table->string('text_direction')->default('LTR');
            $table->string('currency_icon')->default('$');
            $table->string('currency_name')->default('usd');
            $table->string('timezone')->default('UTC');
            $table->tinyInteger('google_analytic')->default('0');
            $table->text('google_analytic_code')->nullable();
            $table->text('theme_one')->default('#1977f4');
            $table->text('theme_two')->default('#f1634c');
            $table->string('google_map_api_key')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
