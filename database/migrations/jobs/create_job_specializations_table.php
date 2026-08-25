<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'job_listings';

    public function up(): void
    {
        if (Schema::connection('job_listings')->hasTable('job_specializations')) {
            return;
        }

        Schema::connection('job_listings')->create('job_specializations', function (Blueprint $table) {
            $table->id();
            $table->enum('seeker_type', ['leadership', 'professional', 'administrative']);
            $table->string('title');
            $table->string('icon')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['seeker_type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::connection('job_listings')->dropIfExists('job_specializations');
    }
};
