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
        Schema::table('ads', function (Blueprint $table) {
            // Front page positions
            $table->boolean('front_top_banner')->default(false);
            $table->boolean('front_bottom')->default(false);

            // Full news page positions
            $table->boolean('news_left_banner')->default(false);
            $table->boolean('news_3_sidebar')->default(false);
            $table->boolean('news_bottom')->default(false);

            // Category/Subcategory positions
            $table->boolean('category_sidebar')->default(false);
            $table->boolean('subcategory_sidebar')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn([
                'front_top_banner',
                'front_bottom',
                'news_left_banner',
                'news_3_sidebar',
                'news_bottom',
                'category_sidebar',
                'subcategory_sidebar',
            ]);
        });
    }
};
