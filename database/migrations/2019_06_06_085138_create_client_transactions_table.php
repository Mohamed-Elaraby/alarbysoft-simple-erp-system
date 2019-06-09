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
            $table->string('amount');
            $table->date('transaction_date');
            $table->integer('user_id')->unsigned();
            $table->integer('sale_order_id')->unsigned()->nullable();
            $table->foreign('sale_order_id')
                ->references('id')
                ->on('sale_orders')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('payment_id')->unsigned()->nullable();
            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onUpdate('CASCADE')
                ->onUpdate('CASCADE');
            $table->integer('collecting_id')->unsigned()->nullable();
            $table->foreign('collecting_id')
                ->references('id')
                ->on('collectings')
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
