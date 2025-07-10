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
            $table->uuid('parent_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete();

            $table->index('parent_id');
        });

        Schema::create('adverts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('category_id');
            $table->string('title', 70);
            $table->text('description');
            $table->decimal('price', 10);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
