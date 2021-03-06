<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id', false, true)->length(10);
            $table->unsignedBigInteger('medicine_id_fk')->nullable();
            $table->foreign('medicine_id_fk')->references('medicine_id')->on('medicines')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_fk')->nullable();
            $table->foreign('user_id_fk')->references('id')->on('users')->onDelete('cascade');
            $table->double('qty_changed', 8, 2);
            $table->string('desc');
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
        Schema::dropIfExists('stocks');
    }
}
