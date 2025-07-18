<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('parent_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index('parent_id');
        });

        Schema::create('adverts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('title', 70);
            $table->text('description');
            $table->decimal('price', 10);
            $table->decimal('average_rating', 2, 1)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('advert_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('advert_id')->constrained('adverts')->cascadeOnDelete();
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
        Schema::dropIfExists('adverts');
        Schema::dropIfExists('categories');
    }
};
