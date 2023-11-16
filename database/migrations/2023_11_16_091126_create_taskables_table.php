<?php

use App\Models\Task;
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
        Schema::create('taskables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignIdFor(Task::class);
            $table->unsignedBigInteger('taskable_id');
            $table->string('taskable_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taskables');
    }
};
