<?php

use App\Models\Business;
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
            $table->string('regNo',255);
            $table->string('businessName');
            $table->text('description');
            $table->string('email');
            $table->string('phone');
            $table->json('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('legalDocs')->nullable();
            $table->date('establishedAt')->nullable();
            $table->json('location')->nullable();
            $table->string('website')->nullable();
            $table->string('socialLinks')->nullable();
            $table->enum('status',Business::$statuses)->default('active');
            $table->timestamp('verified_at')->nullable();
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
