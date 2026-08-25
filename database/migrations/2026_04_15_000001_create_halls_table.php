<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location');
            $table->string('city');
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('max_tables');
            $table->decimal('price_per_day', 10, 2);
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('whatsapp_number', 20)->nullable();
            $table->enum('status', ['pending', 'under_review', 'active', 'inactive'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('halls');
    }
};
