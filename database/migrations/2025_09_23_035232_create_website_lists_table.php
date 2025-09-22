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
        Schema::create('website_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // website name
            $table->text('url')->nullable();    // website URL
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_lists');
    }
};
