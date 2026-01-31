<?php
// FILE: database/migrations/2026_01_29_180000_create_churches_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('subscription_status', ['active', 'inactive', 'trial', 'suspended'])
                ->default('trial');
            $table->timestamps();

            $table->index('subscription_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('churches');
    }
};