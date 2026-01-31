<?php
// FILE: database/migrations/2026_01_29_180002_create_cell_groups_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cell_groups', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('church_id')
                ->constrained('churches')
                ->cascadeOnDelete();
            
            $table->foreignId('leader_id')
                ->constrained('users')
                ->cascadeOnDelete();
            
            $table->string('name');
            $table->timestamps();

            // One leader per church can only have one cell group
            $table->unique(['church_id', 'leader_id']);
            
            // Indexes
            $table->index('church_id');
            $table->index('leader_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cell_groups');
    }
};