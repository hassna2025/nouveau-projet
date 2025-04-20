<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::connection('sqlite_admin')->hasTable('learning_items')) {
            Schema::connection('sqlite_admin')->create('learning_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')->constrained('learning_categories');
                $table->string('title');
                $table->text('content')->nullable();
                $table->string('image_path')->nullable();
                $table->string('audio_path')->nullable();
                $table->string('video_path')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::connection('mysql_secondary')->dropIfExists('learning_items');
    }
};