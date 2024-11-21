<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id'); // Primary key for the appointments table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Referencing 'users' table
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade'); // Assuming doctors are also stored in the 'users' table, otherwise specify the correct table
            $table->dateTime('appointment_date'); // Date and time of the appointment
            $table->enum('status', ['booked', 'completed', 'canceled'])->default('booked'); // Status of the appointment
            $table->text('notes')->nullable(); // Optional notes
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
