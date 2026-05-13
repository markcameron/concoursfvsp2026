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
        Schema::table('photo_albums', function (Blueprint $table) {
            $table->boolean('active')->default(false)->after('sort_order');
            $table->dropColumn('published_at');
        });
    }

    public function down(): void
    {
        Schema::table('photo_albums', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('sort_order');
            $table->dropColumn('active');
        });
    }
};
