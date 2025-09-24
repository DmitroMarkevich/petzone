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
        Schema::create('order_recipients', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('order_id')->constrained('orders')->cascadeOnDelete();

            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('phone_number', 20);

            $table->string('warehouse_ref')->nullable();
            $table->string('warehouse_title')->nullable();
            $table->string('warehouse_settlement_type')->nullable();
            $table->string('warehouse_city')->nullable();
            $table->string('warehouse_region')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_recipients');
    }
};
