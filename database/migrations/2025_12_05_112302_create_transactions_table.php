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
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method'); // gcash, paypal
            $table->string('transaction_reference')->nullable(); // GCash ref number, PayPal transaction ID
            $table->string('payment_proof')->nullable(); // screenshot/receipt upload
            $table->enum('status', ['pending', 'verified', 'rejected', 'refunded'])->default('pending');
            $table->text('admin_notes')->nullable(); // Admin can add notes when verifying
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who verified
            $table->timestamp('verified_at')->nullable();
            $table->string('payment_status')->default('unpaid')->change();
            $table->timestamps();
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