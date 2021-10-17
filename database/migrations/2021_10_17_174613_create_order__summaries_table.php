<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order__summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_id');
            $table->string('voucher_name')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('shipping_fee')->nullable();
            $table->integer('sub_total');
            $table->integer('total_price');
            $table->integer('payment_status')->nullable()->default(1)->comment('1=unpaid, 2=paid');
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
        Schema::dropIfExists('order__summaries');
    }
}
