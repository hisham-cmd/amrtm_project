<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commercial_agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_en')->nullable();
            $table->string('logo')->nullable();
            $table->string('category');           // food, tech, retail, beauty, industrial, services
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->string('country_origin')->default('السعودية');
            $table->json('available_regions')->nullable();
            $table->enum('agency_type', ['exclusive_agent','distributor','strategic_partner','reseller','certified_dealer'])->default('exclusive_agent');
            $table->unsignedBigInteger('investment_min')->default(0);
            $table->unsignedBigInteger('investment_max')->default(0);
            $table->unsignedSmallInteger('min_years_experience')->default(0);
            $table->json('requirements')->nullable();
            $table->json('benefits')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(true);
            $table->enum('status', ['active','inactive','draft'])->default('active');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commercial_agencies');
    }
};
