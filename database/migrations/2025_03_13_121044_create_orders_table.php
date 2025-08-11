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
            $table->uuid('id')->primary();

            $table->string('order_number')->unique();
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(true);

            $table->foreignUuid('buyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('seller_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('advert_id')->constrained('adverts')->cascadeOnDelete();

            $table->string('payment_method');
            $table->string('delivery_method');
            $table->string('tracking_number')->nullable();
            $table->decimal('delivery_cost', 10)->nullable();
            $table->decimal('total_price', 10);
            $table->date('estimated_delivery_date')->nullable();

            $table->string('recipient_last_name')->nullable();
            $table->string('recipient_first_name')->nullable();
            $table->string('recipient_middle_name')->nullable();
            $table->string('recipient_phone')->nullable();

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->text('cancellation_reason')->nullable();

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
