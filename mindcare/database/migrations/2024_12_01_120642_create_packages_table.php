<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id(); // Creates the 'id' field as the primary key
            $table->string('name'); // Package name (e.g., Couples Therapy)
            $table->text('description'); // Package description
            $table->string('category'); // Package category (e.g., For Adults, For Business)
            $table->decimal('price', 10, 2); // Price of the package
            $table->string('duration'); // Duration of the package (e.g., Per Month, Per Session)
            $table->enum('status', ['active', 'inactive'])->default('active'); // Package status (active/inactive)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
