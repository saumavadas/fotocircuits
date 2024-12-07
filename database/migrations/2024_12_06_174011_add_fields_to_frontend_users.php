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
        Schema::table('frontend_users', function (Blueprint $table) 
        {
            $table->string('profile_image')->nullable(); // Add new field 1
            $table->string('status')->nullable(); // Add new field 2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('frontend_users', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'status']);
        });
    }
};
