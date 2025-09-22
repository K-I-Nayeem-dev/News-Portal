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
        Schema::create('ad_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')->constrained('ads')->onDelete('cascade'); // FK to ads
            $table->string('ip')->nullable();         // visitor IP
            $table->string('user_agent')->nullable(); // browser info
            $table->timestamps();                     // click timestamp
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ad_clicks');
    }
};
