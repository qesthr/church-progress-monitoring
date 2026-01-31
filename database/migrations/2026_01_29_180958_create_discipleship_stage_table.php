<?php
// FILE: database/migrations/2026_01_29_180003_create_discipleship_stages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discipleship_stages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->unsignedTinyInteger('sequence_order')->unique();
            
            $table->index('sequence_order');
        });

        // Seed the stages immediately after table creation
        DB::table('discipleship_stages')->insert([
            ['name' => 'evangelized', 'sequence_order' => 1],
            ['name' => 'simbanay', 'sequence_order' => 2],
            ['name' => 'life_class', 'sequence_order' => 3],
            ['name' => 'sol_1', 'sequence_order' => 4],
            ['name' => 'sol_2', 'sequence_order' => 5],
            ['name' => 'sol_3', 'sequence_order' => 6],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('discipleship_stages');
    }
};