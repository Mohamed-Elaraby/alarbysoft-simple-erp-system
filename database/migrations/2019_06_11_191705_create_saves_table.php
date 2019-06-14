<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saves', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount_paid');
            $table->double('final_amount');
            $table->text('comment')->nullable();
            $table->boolean('processType')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('sale_order_id')->unsigned()->nullable();
            $table->integer('client_payment_id')->unsigned()->nullable();
            $table->integer('client_collecting_id')->unsigned()->nullable();
            $table->integer('purchase_order_id')->unsigned()->nullable();
            $table->integer('supplier_payment_id')->unsigned()->nullable();
            $table->integer('supplier_collecting_id')->unsigned()->nullable();
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
        Schema::dropIfExists('saves');
    }
}
