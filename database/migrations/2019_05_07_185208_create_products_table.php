<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->double('purchasing_price');
            $table->double('dealer_price');
            $table->double('selling_price');
            $table->string('quantity');
            $table->string('serialNumber');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('store_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
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
