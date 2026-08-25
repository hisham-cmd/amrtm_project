<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('franchise_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opportunity_id')->nullable()->constrained('franchise_opportunities')->nullOnDelete();
            $table->string('brand_name')->nullable();
            $table->string('full_name');
            $table->string('phone');
            $table->string('email');
            $table->string('region')->nullable();
            $table->string('capital_range')->nullable();
            $table->boolean('has_experience')->default(false);
            $table->text('notes')->nullable();
            $table->enum('status', ['pending', 'reviewing', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_applications');
    }
};
