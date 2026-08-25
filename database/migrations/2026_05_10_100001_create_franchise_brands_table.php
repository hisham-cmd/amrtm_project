<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('franchise_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('logo')->nullable();          // storage path
            $table->string('category');                  // food|edu|fitness|tech|home|retail|beauty
            $table->string('subcategory')->nullable();
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->unsignedBigInteger('investment_min')->default(0);   // SAR
            $table->unsignedBigInteger('investment_max')->default(0);   // SAR
            $table->unsignedSmallInteger('roi_months_min')->default(12);
            $table->unsignedSmallInteger('roi_months_max')->default(24);
            $table->decimal('franchise_fee_percent', 4, 2)->default(5.00);
            $table->json('available_regions')->nullable();
            $table->json('requirements')->nullable();
            $table->json('features')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_auction_eligible')->default(false);
            $table->enum('status', ['active', 'inactive', 'draft'])->default('active');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_brands');
    }
};
