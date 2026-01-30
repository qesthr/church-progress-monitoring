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
        Schema::create('disciple_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('church_id')->constrained('churches')->cascadeOnDelete();
            $table->foreignId('disciple_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('stage_id')->constrained('discipleship_stages')->cascadeOnDelete();

            $table->unsignedTinyInteger('lesson_number'); // lesson number within the stage
            $table->date('completed_at'); // date when the lesson was completed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciple_progress');
    }
};
