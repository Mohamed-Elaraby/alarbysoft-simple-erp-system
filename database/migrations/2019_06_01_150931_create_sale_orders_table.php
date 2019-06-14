<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoiceNo');
            $table->date('invoiceDate');
            $table->text('notes')->nullable();
            $table->double('invoice_subtotal');
            $table->string('tax_percent')->nullable();
            $table->double('tax')->nullable();
            $table->double('invoice_total');
            $table->boolean('payment_method')->default(false);
            $table->double('amount_paid');
            $table->double('amount_due');
            $table->integer('user_id')->unsigned();
            $table->integer('store_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned();
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
        Schema::dropIfExists('sale_orders');
    }
}
