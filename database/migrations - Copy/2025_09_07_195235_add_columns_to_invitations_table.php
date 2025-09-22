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
        Schema::table('invitations', function (Blueprint $table) {
            $table->string('role', 50)->nullable()->after('email');
            $table->string('token', 255)->nullable()->unique()->after('role');
            $table->timestamp('used_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('invitations', function (Blueprint $table) {
            $table->dropColumn(['role', 'token', 'used_at']);
        });
    }
};