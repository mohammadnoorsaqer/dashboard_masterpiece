<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // Use the default 'id' column
            $table->string('code')->unique();
            $table->integer('discount_percentage');
            $table->date('valid_from');
            $table->date(column: 'valid_until');
            $table->enum('status', ['active', 'expired'])->default('active');
            $table->timestamps();
        });
    }
    
    
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
    
};
