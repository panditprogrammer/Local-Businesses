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
        // Migration for the `pricing_feature` pivot table
        Schema::create('pricing_feature', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_id')->constrained()->onDelete('cascade'); // Pricing ID
            $table->foreignId('feature_id')->constrained()->onDelete('cascade'); // Feature ID
            $table->boolean('available')->default(true); // Whether the feature is available for this Pricing
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_feature');
    }
};
