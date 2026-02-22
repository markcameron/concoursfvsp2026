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

            $table->string('name');
            $table->string('url')->nullable();
            $table->foreignId('sponsor_level_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('type', ['commune', 'livret_fete', 'parrainage']);
            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0)->after('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sponsors');
    }
};
