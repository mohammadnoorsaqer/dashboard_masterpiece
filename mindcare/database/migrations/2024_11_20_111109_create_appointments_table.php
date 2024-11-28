<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');
            $table->dateTime('appointment_date');
            $table->enum('status', ['booked', 'completed', 'canceled'])->default('booked');
            $table->decimal('original_price', 8, 2)->nullable();  // Add this column
            $table->decimal('price', 10, 2); // Price of the appointment
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null'); // Applied coupon
            $table->decimal('discount_amount', 10, 2)->nullable(); // Discount amount applied
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
