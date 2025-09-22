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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invited_by')->constrained('users')->onDelete('cascade'); // who invited
            $table->string('name');
            $table->string('email');
            $table->string('role', 50)->nullable(); // optional role
            $table->string('token', 255)->nullable()->unique(); // unique token for invite
            $table->integer('status')->default(0); // 0 = pending, 1 = accepted
            $table->timestamp('used_at')->nullable(); // when invitation was used
            $table->timestamp('expires_at')->nullable(); // optional expiry
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
