<?php

use App\Models\BusinessListing;
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
        Schema::create('business_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description');
            $table->json('location')->nullable();
            $table->decimal("latitude");
            $table->json('address');
            $table->string('banner')->nullable();
            $table->string('website')->nullable();
            $table->json('workingDays')->nullable();
            $table->json('gallery')->nullable();
            $table->text('services')->nullable();
            $table->string('paymentMethods')->nullable();
            $table->json('socialLinks')->nullable();
            $table->decimal('ratings')->nullable();
            $table->enum('status',BusinessListing::$statuses)->default("active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_listings');
    }
};
