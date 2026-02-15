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
        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pamong yang dinilai
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade'); // Kepala SKB
            $table->string('period'); // Format: "2026-01" atau "2026-Q1"
            $table->decimal('score', 5, 2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'period']); // Satu evaluasi per Pamong per periode
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_reviews');
    }
};
