<?php
// FILE: database/migrations/2026_01_29_180004_create_disciple_progress_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disciple_progress', function (Blueprint $table) {
            $table->id();

            // Foreign key to churches table
            $table->foreignId('church_id')
                ->constrained('churches')
                ->cascadeOnDelete();

            // Foreign key to users table (disciples are users)
            $table->foreignId('disciple_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Foreign key to discipleship_stages table (PLURAL!)
            $table->foreignId('stage_id')
                ->constrained('discipleship_stages')
                ->cascadeOnDelete();

            // Lesson data
            $table->unsignedTinyInteger('lesson_number');
            $table->timestamp('completed_at')->useCurrent();

            $table->timestamps();

            // Unique constraint: One lesson per disciple per stage
            $table->unique(
                ['church_id', 'disciple_id', 'stage_id', 'lesson_number'],
                'unique_lesson_completion'
            );

            // Performance indexes
            $table->index(['church_id', 'disciple_id']);
            $table->index(['disciple_id', 'stage_id']);
            $table->index('completed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disciple_progress');
    }
};