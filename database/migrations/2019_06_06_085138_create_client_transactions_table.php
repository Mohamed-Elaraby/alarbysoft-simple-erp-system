<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->date('transaction_date');
            $table->integer('user_id')->unsigned();
            $table->integer('sale_order_id')->unsigned()->nullable();
            $table->foreign('sale_order_id')
                ->references('id')
                ->on('sale_orders')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('purchase_order_id')->unsigned()->nullable();
            $table->foreign('purchase_order_id')
                ->references('id')
                ->on('purchase_orders')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('client_payment_id')->unsigned()->nullable();
            $table->foreign('client_payment_id')
                ->references('id')
                ->on('client_payments')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('client_collecting_id')->unsigned()->nullable();
            $table->foreign('client_collecting_id')
                ->references('id')
                ->on('client_collectings')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
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
        Schema::dropIfExists('client_transactions');
    }
}
