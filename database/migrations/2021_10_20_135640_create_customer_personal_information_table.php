<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerPersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('username');
            $table->string('mobile')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->string('street_address1')->nullable();
            $table->string('street_address2')->nullable();
            $table->integer('zip_code')->nullable();
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
        Schema::dropIfExists('customer_personal_information');
    }
}
