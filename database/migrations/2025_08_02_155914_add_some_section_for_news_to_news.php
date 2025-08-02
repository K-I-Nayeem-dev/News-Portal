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
        Schema::table('news', function (Blueprint $table) {
            $table->string('firstSection_bigThumbnail')->nullable()->default(0);
            $table->string('firstSection')->nullable()->default(0);
            $table->string('genaralBigThumbnail')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['firstSection_bigThumbnail','firstSection','genaralBigThumbnail']);
        });
    }
};
