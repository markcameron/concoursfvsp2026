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
        Schema::create('diaporama_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diaporama_submission_id')->constrained()->cascadeOnDelete();
            $table->string('ip_address', 45);
            $table->string('visitor_id', 36);
            $table->enum('vote', ['up', 'down']);
            $table->timestamps();

            $table->unique(['diaporama_submission_id', 'visitor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diaporama_votes');
    }
};
