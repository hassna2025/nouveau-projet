<?php

// database/migrations/XXXX_create_user_progress_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_user_id')->constrained();
            $table->foreignId('learning_item_id')->constrained('learning_items');
            $table->foreignId('quiz_id')->nullable()->constrained();
            $table->integer('score')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->unique(['child_user_id', 'learning_item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_progress');
    }
};