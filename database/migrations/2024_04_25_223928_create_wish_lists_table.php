<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wish_lists', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('listing_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignUlid('user_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wish_lists');
    }
};
