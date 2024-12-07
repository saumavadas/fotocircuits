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
        Schema::create('seller_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('schedule_date');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('frontend_users')->onDelete('cascade'); // Assuming users table holds sellers.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_schedules');
    }
};
