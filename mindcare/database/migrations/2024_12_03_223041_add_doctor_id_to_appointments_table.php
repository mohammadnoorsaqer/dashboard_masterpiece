<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDoctorIdToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Re-add the doctor_id column
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade'); 
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop the doctor_id column if you want to reverse the migration
            $table->dropColumn('doctor_id');
        });
    }
}
