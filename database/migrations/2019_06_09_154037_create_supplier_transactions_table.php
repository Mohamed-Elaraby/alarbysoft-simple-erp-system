<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->date('transaction_date');
            $table->integer('user_id')->unsigned();
            $table->integer('purchase_order_id')->unsigned()->nullable();
            $table->foreign('purchase_order_id')
                ->references('id')
                ->on('purchase_orders')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('supplier_payment_id')->unsigned()->nullable();
            $table->foreign('supplier_payment_id')
                ->references('id')
                ->on('supplier_payments')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('supplier_collecting_id')->unsigned()->nullable();
            $table->foreign('supplier_collecting_id')
                ->references('id')
                ->on('supplier_collectings')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
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
        Schema::dropIfExists('supplier_transactions');
    }
}
