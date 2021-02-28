<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id('prescription_id', false, true)->length(10);
            $table->unsignedBigInteger('appointment_id_fk')->nullable();
            $table->foreign('appointment_id_fk')->references('appointment_id')->on('appointments')->onDelete('cascade');
            $table->unsignedBigInteger('medicine_id_fk')->nullable();
            $table->foreign('medicine_id_fk')->references('medicine_id')->on('medicines')->onDelete('cascade');
            $table->longText('note')->nullable();
            $table->double('qty');
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
        Schema::dropIfExists('prescriptions');
    }
}
