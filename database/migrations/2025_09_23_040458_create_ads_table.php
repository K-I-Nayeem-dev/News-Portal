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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('url');    // Ad URL
            $table->string('image');  // Ad image path
            $table->integer('type');  // Ad type

            // Front page positions
            $table->boolean('front_top_banner')->default(false);
            $table->boolean('front_bottom')->default(false);

            // Full news page positions
            $table->boolean('news_left_banner')->default(false);
            $table->boolean('news_3_sidebar')->default(false);
            $table->boolean('news_bottom')->default(false);
            $table->boolean('news_details_middle')->default(false);

            // Category/Subcategory positions
            $table->boolean('category_sidebar')->default(false);
            $table->boolean('subcategory_sidebar')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
