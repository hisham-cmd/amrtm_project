<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officiant_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('officiant_id')->constrained('officiants')->cascadeOnDelete();
            $table->string('file_path');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('officiant_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('officiant_id')->constrained('officiants')->cascadeOnDelete();
            $table->string('title', 150);
            $table->text('description')->nullable();
            $table->string('price', 100)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officiant_services');
        Schema::dropIfExists('officiant_media');
    }
};
