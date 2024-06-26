<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignUlid('recipient_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->boolean('is_read')->default(false);
            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
