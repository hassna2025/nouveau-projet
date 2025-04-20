<?php
// database/migrations/xxxx_create_learning_items_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::connection('sqlite_admin')->create('learning_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->on('sqlite_admin.categories');
            $table->string('name');
            $table->text('description');
            $table->integer('difficulty_level')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes(); // Ajoute cette ligne
        });
    }

    public function down()
    {
        Schema::connection('sqlite_admin')->dropIfExists('learning_items');
    }
};