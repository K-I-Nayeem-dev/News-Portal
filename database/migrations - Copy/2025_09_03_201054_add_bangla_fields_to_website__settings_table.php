<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('website__settings', function (Blueprint $table) {
            $table->text('about_us_bangla')->nullable()->after('about_us');
            $table->string('address_bangla')->nullable()->after('address');
            $table->string('editor_details_bangla')->nullable()->after('editor_details');
            $table->string('phone_bangla')->nullable()->after('phone');
        });
    }

    public function down()
    {
        Schema::table('website__settings', function (Blueprint $table) {
            $table->dropColumn(['about_us_bangla', 'address_bangla', 'editor_details_bangla', 'phone_bangla']);
        });
    }
};
