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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');

            $table->string('game');             // Genshin Impact, HSR, ZZZ
            $table->string('service_category'); // Maintenance, Exploration
            $table->string('service_type');     // Daily, Spiral Abyss
            $table->decimal('price', 10, 2);    // 500.00

            // Status & Payment
            $table->string('status')->default('pending'); // pending, in-progress, completed
            $table->string('payment_method')->nullable(); // Gcash, Paypal
            $table->string('payment_status')->default('unpaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
