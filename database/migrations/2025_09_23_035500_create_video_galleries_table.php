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
        Schema::create('video_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Video title
            $table->text('embed_code');       // YouTube/Vimeo embed code
            $table->string('type');           // Optional type/category
            $table->string('special_news')->nullable()->default(0); // Flag for special news
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('video_galleries');
    }
};
