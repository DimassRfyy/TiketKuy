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
        Schema::disableForeignKeyConstraints();

        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('video_url')->nullable();
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('price');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->time('opened_at');
            $table->time('closed_at');
            $table->boolean('is_popular');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
