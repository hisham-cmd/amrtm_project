<?php
// database/migrations/2025_01_01_000002_create_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();        // ministries, authorities, companies, embassies
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('icon')->default('ti-building');
            $table->string('color')->default('#1A237E');
            $table->string('bg')->default('rgba(26,35,126,.1)');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('icon')->default('ti-building');
            $table->string('color')->default('#1A237E');
            $table->string('bg')->default('rgba(26,35,126,.1)');
            $table->string('tag_ar')->nullable();
            $table->string('tag_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained()->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('icon')->default('ti-file-text');
            $table->decimal('price', 10, 2)->default(0);
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('estimated_days')->default(3); // estimated completion days
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('entities');
        Schema::dropIfExists('categories');
    }
};
