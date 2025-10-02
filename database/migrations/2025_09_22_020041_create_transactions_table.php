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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');               // e.g. "Payment for Order #123"
            $table->decimal('amount', 12, 2);      // 999,999,999,999.99 max
            $table->enum('type', ['credit', 'debit']); // transaction direction
            $table->timestamps();

            $table->index(['type']);
            // owner member
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
