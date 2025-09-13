<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('parent_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->string('name');
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index('parent_id');
        });

        Schema::create('advert', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('category_id')->constrained('categories')->cascadeOnDelete();

            $table->string('title', 70);
            $table->text('description');
            $table->decimal('price', 10);
            $table->decimal('average_rating', 2, 1)->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('is_active', 'idx_adverts_is_active');
            $table->index(['is_active', 'price'], 'idx_adverts_active_price');
            $table->index(['is_active', 'created_at'], 'idx_adverts_active_created');
        });

        Schema::create('advert_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('advert_id')->constrained('advert')->cascadeOnDelete();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();

            $table->text('comment');
            $table->unsignedTinyInteger('rating');

            $table->timestamps();

            $table->unique(['advert_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_comments');
        Schema::dropIfExists('advert_images');
        Schema::dropIfExists('advert');
        Schema::dropIfExists('categories');
    }
};
