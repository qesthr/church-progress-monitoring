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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('disciple'); // pastor, leader, disciple
            $table->unsignedBigInteger('leader_id')->nullable(); // self-referencing leader
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['leader_id']);
            $table->dropColumn(['role', 'leader_id']);
        });
    }

};
