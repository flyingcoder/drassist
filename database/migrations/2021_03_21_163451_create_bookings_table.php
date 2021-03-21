<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('is_patient')->nullable();
            $table->string('you_received_care')->nullable();
            $table->string('patient_relationship')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('patient_received_care')->nullable();
            $table->string('patient_legal_first_name')->nullable();
            $table->string('patient_legal_middle_name')->nullable();
            $table->string('patient_legal_last_name')->nullable();
            $table->string('main_clinic_number')->nullable();
            $table->string('your_legal_first_name')->nullable();
            $table->string('your_legal_middle_name')->nullable();
            $table->string('your_legal_last_name')->nullable();
            $table->string('patient_birthdate')->nullable();
            $table->string('patient_contact_number')->nullable();
            $table->string('patient_email')->nullable();
            $table->string('patient_interpreter')->nullable();
            $table->string('patient_email2')->nullable();
            $table->string('patient_gender')->nullable();
            $table->string('patient_street_address')->nullable();
            $table->string('patient_city')->nullable();
            $table->string('patient_state')->nullable();
            $table->string('patient_home_number')->nullable();
            $table->text('patient_primary_concern')->nullable();
            $table->text('patient_medical_concern')->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->string('OHIP_number')->nullable();
            $table->string('patient_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
