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
            $table->double('purchase_price')->nullable();
            $table->double('dealer_price')->nullable();
            $table->double('selling_price')->nullable();
            $table->string('quantity')->nullable();
            $table->integer('invoiceNo')->unsigned()->nullable();
            $table->integer('purchase_order_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('supplier_id')->unsigned()->nullable();
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
