<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diaporama_moderation_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diaporama_submission_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['approved', 'flagged', 'rejected', 'error']);
            $table->json('scores')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diaporama_moderation_logs');
    }
};
