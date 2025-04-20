<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('sqlite_admin')->table('learning_items', function (Blueprint $table) {
            $table->softDeletes(); // Ajoute la colonne deleted_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sqlite_admin')->table('learning_items', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Supprime la colonne deleted_at
        });
    }
};