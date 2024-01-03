<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MrVaco\OrchidStatuses\Classes\StatusClass;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mr_vaco__blog_posts', function(Blueprint $table)
        {
            $table->id();

            $table->unsignedInteger('category_id')->default(1);
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->string('keywords')->nullable();
            $table->string('tags')->nullable();
            $table->text('introductory');
            $table->longText('content');
            $table->unsignedInteger('status')->default(StatusClass::DRAFT()->id);
            $table->unsignedBigInteger('image')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('updator_id');
            $table->timestamp('published_at')->nullable();
            $table->boolean('recommended')->default(false);
            $table->unsignedBigInteger('gallery_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mr_vaco__blog_posts');
    }
};
