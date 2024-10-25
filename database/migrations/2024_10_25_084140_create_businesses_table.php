<?php

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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id');
            $table->string('name',50);
            $table->string('address')->nullable();
            $table->text('description');
            $table->string('website')->nullable();
            $table->string('workingDaysandHours')->nullable();
            $table->string('images')->nullable();
            $table->string('socialLinks')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('services')->nullable();
            $table->string('ratings')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
