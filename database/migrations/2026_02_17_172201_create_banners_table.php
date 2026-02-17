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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->text('message')->required();
            $table->string('link')->nullable();
            $table->string('link_text')->nullable()->default('En savoir plus');
            $table->boolean('is_active')->default(false);
            $table->enum('color', ['blue', 'red'])->default('blue');
            $table->boolean('open_in_new_tab')->default(false);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
