<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product__attributes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->string('color_id')->nullable();
            $table->string('size_id')->nullable();
            $table->string('regular_price');
            $table->string('offer_price')->nullable();
            $table->string('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product__attributes');
    }
}
