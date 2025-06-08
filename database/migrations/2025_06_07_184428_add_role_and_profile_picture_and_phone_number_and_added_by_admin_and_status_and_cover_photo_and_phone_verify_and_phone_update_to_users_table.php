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
            $table->string('role')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_verify')->nullable()->default(0);
            $table->string('phone_update')->nullable()->default(0);
            $table->string('added_by_admin')->nullable()->default(0);
            $table->string('status')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'profile_picture',
                'cover_photo',
                'phone_number',
                'phone_verify',
                'phone_update',
                'added_by_admin',
                'status'
            ]);
        });
    }
};