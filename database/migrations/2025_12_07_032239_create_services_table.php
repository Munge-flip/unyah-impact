<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('game'); // Genshin Impact, HSR, ZZZ
            $table->string('category_name'); // e.g., "Maintenance", "Regular Quests" (Display Name)
            $table->string('category'); // e.g., "maintenance", "quests" (For JS logic)
            $table->string('name'); // e.g., "Daily", "Weekly" (Display Name)
            $table->string('slug'); // e.g., "daily", "weekly" (For JS logic)
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};