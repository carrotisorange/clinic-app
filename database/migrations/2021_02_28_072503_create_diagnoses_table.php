<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id('diagnoses_id', false, true)->length(10);
            $table->unsignedBigInteger('appointment_id_fk')->nullable();
            $table->foreign('appointment_id_fk')->references('appointment_id')->on('appointments')->onDelete('cascade');
            $table->longText('symptoms');
            $table->double('temperature', 8, 2);
            $table->string('blood_pressure');
            $table->double('weight', 8, 2);
            $table->double('height', 8, 2);
            
            $table->double('bmi', 8, 2);
            $table->double('cr', 8, 2);
            $table->double('rr', 8, 2);
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
        Schema::dropIfExists('diagnoses');
    }
}
