<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('purchase_price')->nullable();
            $table->double('price');
            $table->string('quantity');
            $table->double('total');
            $table->double('total_purchase_price');
            $table->string('serial')->nullable();
            $table->string('invoiceNo')->nullable();
            $table->integer('sale_order_id')->unsigned();
            $table->foreign('sale_order_id')
                ->references('id')
                ->on('sale_orders')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('sale_order_products');
    }
}
