<?php
// FILE: database/migrations/2026_01_29_180001_create_users_table.php
// This is the ONLY users migration you need - includes ALL fields

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
            
            // Multi-tenant: Each user belongs to a church
            $table->foreignId('church_id')
                ->constrained('churches')
                ->cascadeOnDelete();
            
            // Basic user info
            $table->string('name');
            $table->string('email');
            $table->string('password');
            
            // RBAC: Role-based access control
            $table->enum('role', ['pastor', 'leader', 'disciple'])
                ->default('disciple');
            
            // Hierarchy: Disciples belong to leaders
            // Leaders and pastors have leader_id = NULL
            $table->foreignId('leader_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            
            // Laravel auth
            $table->rememberToken();
            $table->timestamps();

            // Business rules
            $table->unique(['church_id', 'email'], 'unique_email_per_church');
            
            // Performance indexes for RBAC queries
            $table->index(['church_id', 'role'], 'idx_church_role');
            $table->index('leader_id', 'idx_leader_id');
            $table->index('email', 'idx_email');
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