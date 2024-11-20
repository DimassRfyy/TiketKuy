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

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->foreignId('ticket_id')->constrained();
            $table->unsignedInteger('total_participant');
            $table->date('booking_date');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('total');
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('transfer');
            $table->string('payment_proof')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
