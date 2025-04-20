<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained();
            $table->enum('type', ['image', 'audio', 'video']);
            $table->string('path');
            $table->string('alt_text')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('media');
    }
};