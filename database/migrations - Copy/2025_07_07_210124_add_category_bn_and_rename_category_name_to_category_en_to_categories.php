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
        Schema::table('categories', function (Blueprint $table) {
            $table->renameColumn('category_name', 'category_en');
            $table->string('category_bn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            Schema::table('news', function (Blueprint $table) {
                $table->renameColumn('category_name', 'category_en');
                $table->dropColumn('category_bn');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
};
