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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title')->unique();
            $table->longText('body');
            $table->string('image_path')->nullable();
            $table->smallInteger('time_to_read')->default(2);
            $table->boolean('is_published')->default(true);
            $table->smallInteger('priority')->default(1);
            $table->timestamps();
            $table->string('category')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
