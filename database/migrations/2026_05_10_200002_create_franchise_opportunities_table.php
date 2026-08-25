<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('franchise_opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('category')->default('food'); // food, edu, fitness, tech, home, services
            $table->text('description')->nullable();
            $table->string('icon')->default('fa-store');           // FontAwesome class
            $table->string('gradient_from')->default('#0d2448');   // CSS color
            $table->string('gradient_to')->default('#1a4a8a');
            $table->string('badge_text')->nullable();
            $table->unsignedBigInteger('investment_min')->default(0);
            $table->unsignedBigInteger('investment_max')->default(0);
            $table->unsignedInteger('roi_months_min')->default(12);
            $table->unsignedInteger('roi_months_max')->default(24);
            $table->decimal('franchise_fee_percent', 4, 1)->default(5.0);
            $table->json('available_regions')->nullable();
            $table->json('requirements')->nullable();  // array of requirement tag strings
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('franchise_opportunities');
    }
};
