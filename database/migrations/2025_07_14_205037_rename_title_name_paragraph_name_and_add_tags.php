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
            $table->renameColumn('title', 'title_en');
            $table->string('title_bn');
            $table->renameColumn('paragraph', 'details_en');
            $table->string('details_bn');
            $table->string('tags_en');
            $table->string('tags_bn');
            $table->string('dist_id');
            $table->string('sub_dist_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->renameColumn('details_en','paragraph');
            $table->renameColumn('title_en', 'title');

            $table->dropColumn([
                'title_bn',
                'details_bn',
                'tags_en',
                'tags_bn',
                'dist_id',
                'sub_dist_id',
            ]);
        });
    }
};