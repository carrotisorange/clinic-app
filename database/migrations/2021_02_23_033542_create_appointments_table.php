<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id', false, true)->length(10);
            $table->unsignedBigInteger('patient_id_fk')->nullable();
            $table->foreign('patient_id_fk')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->unsignedBigInteger('doctor_id_fk')->nullable();
            $table->foreign('doctor_id_fk')->references('doctor_id')->on('doctors')->onDelete('cascade');
            $table->date('date');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->longText("desc");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
