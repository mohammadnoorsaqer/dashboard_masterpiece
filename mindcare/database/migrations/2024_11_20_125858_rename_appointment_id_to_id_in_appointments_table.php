<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAppointmentIdToIdInAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Rename appointment_id to id
            $table->renameColumn('appointment_id', 'id');
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Revert back the renaming in case of rollback
            $table->renameColumn('id', 'appointment_id');
        });
    }
}
