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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('certify');
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('health_card_province')->nullable();
            $table->string('health_card')->nullable();
            $table->integer('age')->nullable();
            $table->string('relationship')->nullable();
            $table->string('health_card_exp')->nullable();
            $table->string('health_card_issue')->nullable();
            $table->string('health_card_number')->nullable();
            $table->string('date_of_birth')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
