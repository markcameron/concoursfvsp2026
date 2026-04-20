<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moderation_settings', function (Blueprint $table) {
            $table->id();
            // Sexual content
            $table->decimal('sexual_review', 3, 2)->default(0.30);
            $table->decimal('sexual_reject', 3, 2)->default(0.80);
            $table->decimal('sexual_minors_reject', 3, 2)->default(0.20);
            // Violence
            $table->decimal('violence_review', 3, 2)->default(0.40);
            $table->decimal('violence_reject', 3, 2)->default(0.80);
            // Hate
            $table->decimal('hate_review', 3, 2)->default(0.40);
            $table->decimal('hate_reject', 3, 2)->default(0.80);
            // Harassment
            $table->decimal('harassment_review', 3, 2)->default(0.50);
            $table->decimal('harassment_reject', 3, 2)->default(0.80);
            // Self-harm
            $table->decimal('self_harm_review', 3, 2)->default(0.40);
            $table->decimal('self_harm_reject', 3, 2)->default(0.80);
            // Illicit
            $table->decimal('illicit_review', 3, 2)->default(0.40);
            $table->decimal('illicit_reject', 3, 2)->default(0.80);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moderation_settings');
    }
};
