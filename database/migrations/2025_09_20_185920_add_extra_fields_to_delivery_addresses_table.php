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
        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->string('city_ref')->nullable()->after('city');
            $table->string('area')->nullable()->after('apartment');
            $table->string('parent_region_code')->nullable()->after('area');
            $table->string('parent_region_types')->nullable()->after('parent_region_code');
            $table->string('settlement_type_code')->nullable()->after('parent_region_types');
            $table->string('present')->nullable()->after('settlement_type_code');

            $table->string('street')->nullable()->change();
            $table->string('apartment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('delivery_addresses', function (Blueprint $table) {
            $table->dropColumn([
                'area',
                'parent_region_code',
                'parent_region_types',
                'settlement_type_code',
                'present'
            ]);

            $table->string('city_ref')->nullable()->change();
            $table->string('street')->nullable()->change();
            $table->string('apartment')->nullable()->change();
        });
    }
};
