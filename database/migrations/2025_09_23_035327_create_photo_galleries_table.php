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
        Schema::create('photo_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();          // Gallery title
            $table->string('title_bn')->nullable();          // Gallery title
            $table->string('type')->nullable()->default(0); // Optional type/category
            $table->string('image')->nullable();          // Main image
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photo_galleries');
    }
};
