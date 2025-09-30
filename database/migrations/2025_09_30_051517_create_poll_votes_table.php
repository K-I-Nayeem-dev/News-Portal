<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained()->onDelete('cascade');
            $table->foreignId('poll_option_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');        // Voter's IP
            $table->string('user_agent')->nullable();
            $table->timestamps();

            // One vote per IP per poll
            $table->unique(['poll_id', 'ip_address']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('poll_votes');
    }
};
