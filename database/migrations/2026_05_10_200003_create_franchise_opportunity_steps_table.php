<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('franchise_opportunity_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->constrained('franchise_opportunities')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->default('fa-circle');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('franchise_opportunity_steps');
    }
};
