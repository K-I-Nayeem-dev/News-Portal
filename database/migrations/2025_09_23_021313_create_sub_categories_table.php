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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade'); // If category is deleted → delete subcategories
            $table->string('sub_cate_en');
            $table->string('sub_cate_bn')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
            $table->integer('order')->default(0); // 👈 Sorting inside category
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
