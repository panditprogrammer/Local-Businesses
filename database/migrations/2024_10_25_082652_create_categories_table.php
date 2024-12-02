<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->bigInteger('parent_id')->nullable(); // id from this categories 
            $table->string('name', 20);
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->enum('status',Category::$statuses)->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
