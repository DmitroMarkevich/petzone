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

            $table->uuid('buyer_id');
            $table->uuid('advert_id');

            $table->string('payment_method');

            $table->string('delivery_method');
            $table->string('tracking_number')->nullable();
            $table->decimal('delivery_cost', 10)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->date('estimated_delivery_date')->nullable();

            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->text('cancellation_reason')->nullable();

            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade');
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
