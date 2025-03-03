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
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('adverts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title', 70);
            $table->text('description');
            $table->decimal('price', 10);
            $table->uuid('category_id');
            $table->uuid('user_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('advert_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('image_path');
            $table->uuid('advert_id');
            $table->timestamps();

            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade');
        });

        Schema::create('advert_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('comment');
            $table->unsignedTinyInteger('rating');
            $table->uuid('advert_id');
            $table->uuid('user_id');
            $table->timestamps();

            $table->foreign('advert_id')->references('id')->on('adverts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_comments');
        Schema::dropIfExists('advert_images');
        Schema::dropIfExists('adverts');
        Schema::dropIfExists('categories');
    }
};
