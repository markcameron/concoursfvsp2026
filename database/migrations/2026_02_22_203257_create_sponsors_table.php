<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('sponsor_level_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');
            $table->string('url')->nullable();
            $table->string('type');
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
