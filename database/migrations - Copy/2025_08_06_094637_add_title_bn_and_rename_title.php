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
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->renameColumn('title', 'title_en');
            $table->string('title_bn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->renameColumn('title_en', 'title');
            $table->dropColumn('title_bn');
        });
    }
};
