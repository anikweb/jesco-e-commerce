<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->string('brand')->nullable()->default('None');
            $table->string('main_upper_material')->nullable()->default('None');
            $table->string('outsole_material')->nullable()->default('None');
            $table->string('gender');
            $table->text('summary');
            $table->text('description');
            $table->string('sku');
            $table->string('origin')->nullable()->default('None');
            $table->string('warranty')->default('None');
            $table->string('return')->default('None');
            $table->string('authentic')->nullable();
            $table->string('promotions')->nullable();
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
        Schema::dropIfExists('products');
    }
}
