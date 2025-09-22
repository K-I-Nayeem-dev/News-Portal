<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // bigint auto increment

            // Basic info
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            // Profile info
            $table->string('profile_picture')->nullable();
            $table->string('cover_photo')->nullable();

            // Phone info
            $table->string('phone_number')->nullable()->unique();
            $table->boolean('phone_verify')->default(false);
            $table->boolean('phone_update')->default(false);

            // Account management
            $table->boolean('added_by_admin')->default(false);
            $table->boolean('status')->default(true); // 1 = active, 0 = inactive
            $table->integer('otp_send')->default(0);

            // Role & Invites
            $table->unsignedBigInteger('invited_user')->nullable();

            // Laravel defaults
            $table->rememberToken();
            $table->timestamps();

            // Self-referencing foreign key
            $table->foreign('invited_user')
                ->references('id')->on('users')
                ->nullOnDelete();
        });

        // Password Reset Tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Sessions
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
