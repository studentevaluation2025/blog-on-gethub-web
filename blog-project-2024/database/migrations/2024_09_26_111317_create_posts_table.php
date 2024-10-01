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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_code');
            $table->string('post_name');
            $table->string('post_slug')->unique();
            $table->text('post_summary');
            $table->longText('post_details');
            $table->string('feature_image');
            $table->boolean('status')->default(1);
            $table->boolean('post_feature')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
