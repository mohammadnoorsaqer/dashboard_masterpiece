<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_comments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id'); // Unique ID for each comment
            $table->foreignId('article_id')->constrained()->onDelete('cascade'); // Foreign key to the articles table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to the users table
            $table->text('content'); // The content of the comment
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
