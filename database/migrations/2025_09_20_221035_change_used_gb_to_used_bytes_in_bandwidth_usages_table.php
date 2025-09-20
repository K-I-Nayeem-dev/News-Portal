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
        Schema::table('bandwidth_usages', function (Blueprint $table) {
            // rename column
            $table->renameColumn('used_gb', 'used_bytes');
        });

        Schema::table('bandwidth_usages', function (Blueprint $table) {
            // modify datatype + default
            $table->unsignedBigInteger('used_bytes')->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('bandwidth_usages', function (Blueprint $table) {
            // rollback: rename back
            $table->renameColumn('used_bytes', 'used_gb');
        });

        Schema::table('bandwidth_usages', function (Blueprint $table) {
            // optional: restore original type if needed (adjust to your old schema)
            $table->integer('used_gb')->default(0)->change();
        });
    }
};
