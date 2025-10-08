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
        Schema::create('news_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->cascadeOnDelete();

            // Visitor info
            $table->string('ip_address', 45)->nullable();       // IPv4 + IPv6
            $table->string('user_agent', 1024)->nullable();
            $table->string('device_type', 50)->nullable();      // desktop / mobile / tablet

            // Timestamp for analytics
            $table->timestamp('viewed_at')->useCurrent();

            // Default Laravel timestamps
            $table->timestamps();

            // Indexes
            $table->index(['news_id', 'ip_address']);
            $table->index(['news_id']);
            $table->index('viewed_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_views');
    }
};
