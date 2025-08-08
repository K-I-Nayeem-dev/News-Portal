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
            $table->renameColumn('news', 'news_en');
            $table->string('news_bn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breaking_news', function (Blueprint $table) {
            $table->renameColumn('news_en', 'news');
            $table->dropColumn('news_bn');
        });
    }
};
