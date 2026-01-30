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
            $table->string('role')->default('disciple'); // default is disciple
            $table->unsignedBigInteger('church_id')->nullable(); // the church this user belongs to
            $table->foreign('church_id')->references('id')->on('churches')->onDelete('cascade');
        
            $table->unsignedBigInteger('leader_id')->nullable(); // the user who is this disciple's leader
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['church_id']);
            $table->dropColumn(['role', 'church_id']);
        });
    }

};
