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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('church_id')->constrained('churches');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->enum('role', ['pastor', 'leader', 'disciple'])->default('disciple');
            
            // self-referencing: who disciples this user
            $table->foreignId('leader_id')->nullable()->constrained('users');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
