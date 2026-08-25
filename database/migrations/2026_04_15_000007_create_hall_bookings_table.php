<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hall_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained('halls')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('owner_name');
            $table->date('booking_date');
            $table->enum('occasion_type', [
                'wedding', 'engagement', 'birthday',
                'corporate', 'graduation', 'meeting', 'other'
            ]);
            $table->unsignedInteger('guests_count');
            $table->unsignedInteger('tables_count');
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_bookings');
    }
};
