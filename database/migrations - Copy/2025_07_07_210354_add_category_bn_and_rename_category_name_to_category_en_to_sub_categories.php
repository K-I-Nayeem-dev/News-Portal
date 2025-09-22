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
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->renameColumn('sub_cate_name', 'sub_cate_en');
            $table->string('sub_cate_bn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sub_categories', function (Blueprint $table) {
            $table->renameColumn('sub_cate_en', 'sub_cate_name');
            $table->dropColumn('sub_cate_bn');
        });
    }
};