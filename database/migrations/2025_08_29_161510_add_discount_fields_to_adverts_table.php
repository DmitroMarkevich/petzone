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
        Schema::table('advert', function (Blueprint $table) {
            $table->decimal('previous_price', 10)->nullable()->after('price');
            $table->timestamp('price_changed_at')->nullable()->after('previous_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('advert', function (Blueprint $table) {
            $table->dropColumn(['previous_price', 'price_changed_at']);
        });
    }
};
