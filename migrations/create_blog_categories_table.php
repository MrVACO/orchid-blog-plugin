<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use MrVaco\OrchidStatuses\Classes\StatusClass;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mr_vaco__blog_categories', function(Blueprint $table)
        {
            $table->id();

            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('keywords')->nullable();
            $table->string('tags')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('status')->default(StatusClass::DRAFT()->id);
            $table->string('image')->nullable();
            $table->unsignedBigInteger('creator_id')->unsigned();
            $table->unsignedBigInteger('updator_id')->unsigned();
            $table->boolean('hidden')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mr_vaco__blog_categories');
    }
};
