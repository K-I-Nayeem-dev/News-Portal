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
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            // Category & Subcategory
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('sub_cate_id')->nullable()->constrained('sub_categories')->onDelete('set null');

            // Author & updater
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('update_by_user')->nullable()->constrained('users')->onDelete('set null');

            // Location
            $table->foreignId('division_id')->constrained('divisions')->onDelete('cascade');
            $table->foreignId('dist_id')->nullable()->constrained('districts')->onDelete('set null');
            $table->foreignId('sub_dist_id')->nullable()->constrained('sub_districts')->onDelete('set null');

            // Titles
            $table->string('title_en');
            $table->string('title_bn')->nullable();

            // Content
            $table->longText('details_en');
            $table->longText('details_bn')->nullable();

            // Images
            $table->string('thumbnail')->nullable();
            $table->string('news_photo')->nullable(); // or separate table for multiple images
            $table->string('image_title')->nullable();
            $table->string('news_source')->nullable();
            $table->string('url')->nullable(); // optional YouTube URL

            // Status & flags
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('trendyNews')->nullable()->default(0);
            $table->tinyInteger('firstSection_bigThumbnail')->nullable()->default(0);
            $table->tinyInteger('firstSection')->nullable()->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
