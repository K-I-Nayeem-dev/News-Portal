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
        Schema::create('bandwidth_usages', function (Blueprint $table) {
            $table->id();
            $table->string('month'); // e.g., "March 2023"
            $table->unsignedBigInteger('used_bytes')->default(0); // renamed from used_gb and set datatype
            $table->json('daily_data'); // daily usage array
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bandwidth_usages');
    }
};
