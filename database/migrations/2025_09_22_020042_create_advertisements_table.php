<?php

use Brick\Math\BigInteger;
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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('city');
            $table->string('country', 100);
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('no_rooms')->nullable();
            $table->unsignedInteger('property_size')->nullable();
            $table->decimal('price', 12, 2)->nullable();
            $table->string('property_type', 50);
            $table->timestamps();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->BigInteger('admin_id')->nullable();
            $table->string('image_path')->nullable();
            // Indexing for quick reads
            $table->index(['city', 'country']);
            $table->index(['property_type']);
            $table->index(['price']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
