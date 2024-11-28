<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->boolean('resolved')->default(false);  // Added resolved column
            $table->boolean('irresolved')->default(true); // Added unresolved column
        });
    }
    
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn(['resolved', 'irresolved']);
        });
    }
    
};
