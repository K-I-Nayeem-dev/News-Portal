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
        Schema::create('website__settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->text('about_us')->nullable();
            $table->text('about_us_bangla')->nullable();
            $table->string('address')->nullable();
            $table->string('address_bangla')->nullable();
            $table->string('editor_details')->nullable();
            $table->string('editor_details_bangla')->nullable();
            $table->string('advertise_link')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_bangla')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website__settings');
    }
};
