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
            $table->unsignedBigInteger('display_count')->default(0)->after('moderation_scores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('diaporama_submissions', function (Blueprint $table) {
            $table->dropColumn('display_count');
        });
    }
};
