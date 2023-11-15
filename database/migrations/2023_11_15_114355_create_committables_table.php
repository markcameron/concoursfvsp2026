<?php

use App\Models\Committee;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('committables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(Committee::class);
            $table->morphs('committable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committables');
    }
};
