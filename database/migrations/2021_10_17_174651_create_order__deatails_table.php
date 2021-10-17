<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDeatailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__deatails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_summary_id');
            $table->foreignId('product_id');
            $table->foreignId('color_id');
            $table->foreignId('size_id');
            $table->foreignId('quantity');
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
        Schema::dropIfExists('order__deatails');
    }
}
