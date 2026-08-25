<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hall_busy_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hall_id')->constrained('halls')->cascadeOnDelete();
            $table->date('busy_date');
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->unique(['hall_id', 'busy_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hall_busy_dates');
    }
};
