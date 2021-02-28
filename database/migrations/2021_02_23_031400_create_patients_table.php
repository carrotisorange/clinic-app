<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id', false, true)->length(10);
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->date('birthdate');
            $table->longText('address');
            $table->string('contact_number');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->string('civil_status');
            $table->string('educational_attainment'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
