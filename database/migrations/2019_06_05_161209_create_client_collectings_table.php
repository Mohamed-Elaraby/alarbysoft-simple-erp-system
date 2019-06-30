<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientCollectingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_collectings', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->text('comment')->nullable();
            $table->date('collect_date');
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
        Schema::dropIfExists('client_collectings');
    }
}
