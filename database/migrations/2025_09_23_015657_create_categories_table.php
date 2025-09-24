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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Auto increment ID
            $table->string('category_en');
            $table->string('category_bn')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->tinyInteger('status')->default(1); // 1 = active, 0 = inactive
            $table->integer('order')->default(0); // 👈 Sorting for menu
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
