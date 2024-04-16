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
            $table->ulid('id')->primary();
            $table->foreignUlid('listing_id')->constrained('listings')->onDelete('cascade');
            $table->foreignId('guest_id')->constrained('users')->onDelete('cascade');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->decimal('total_price', 8, 2);
            $table->string('status')->default('pending'); // 'pending', 'confirmed', 'canceled'
            $table->text('special_requests')->nullable(); // Guest's special requests
            $table->softDeletes();
            $table->timestamps();
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
