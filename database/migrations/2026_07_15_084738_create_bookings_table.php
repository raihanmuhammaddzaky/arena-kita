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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('venue_id')->constrained()->cascadeOnDelete();
            $table->date('booking_date')->index();
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('total_price');
            $table->enum('status', ['unpaid', 'pending_verification', 'confirmed', 'cancelled'])->default('unpaid');
            $table->timestamps();
            
            $table->index(['venue_id', 'booking_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
