<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->nullable();
            $table->string('tagline')->nullable();
            $table->string('logo')->nullable();
            $table->string('icon')->nullable();
            $table->string('key_words')->nullable();
            $table->tinyInteger('new_registration')->nullable()->default(1)->comment('1 = disabled, 2 = enabled');
            $table->tinyInteger('new_login')->nullable()->default(1)->comment('1 = disabled, 2 = enabled');
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
        Schema::dropIfExists('basic_settings');
    }
}
