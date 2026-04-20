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
        Schema::table('diaporama_submissions', function (Blueprint $table) {
            $table->dropColumn('approved_at');
            $table->enum('status', ['pending', 'flagged', 'rejected', 'approved'])
                ->default('pending')
                ->after('caption')
                ->index();
            $table->json('moderation_scores')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diaporama_submissions', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropColumn(['status', 'moderation_scores']);
            $table->timestamp('approved_at')->nullable();
        });
    }
};
