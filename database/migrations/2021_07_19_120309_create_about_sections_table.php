<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('header')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->string('section_name');
            $table->integer('content_quantity')->default(0);
            $table->tinyInteger('show_homepage')->default(1);
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
        Schema::dropIfExists('about_sections');
    }
}
