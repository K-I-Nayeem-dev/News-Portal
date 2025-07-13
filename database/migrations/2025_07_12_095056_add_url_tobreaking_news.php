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
        Schema::table('breaking_news', function (Blueprint $table) {
            $table->string('url', 2048)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breaking_news', function (Blueprint $table) {
            $table->dropColumn('url');
        });
    }
};
