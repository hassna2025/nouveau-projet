<?php

// database/migrations/XXXX_create_child_users_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('child_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('avatar')->nullable();
            $table->integer('age');
            $table->integer('points')->default(0);
            $table->foreignId('parent_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('child_users');
    }
};
