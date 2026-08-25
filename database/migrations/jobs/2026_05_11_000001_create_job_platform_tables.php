<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'job_listings';

    public function up(): void
    {
        if (!Schema::connection('job_listings')->hasTable('users'))
        Schema::connection('job_listings')->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('user_type', ['job_seeker', 'company', 'admin'])->default('job_seeker');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        if (!Schema::connection('job_listings')->hasTable('companies'))
        Schema::connection('job_listings')->create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name');
            $table->enum('company_type', ['transfer', 'employment', 'leasing', 'other'])->nullable();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->default('Other');
            $table->integer('employee_count')->nullable();
            $table->string('location');
            $table->string('phone');
            $table->string('hr_contact_name');
            $table->string('hr_contact_email');
            $table->text('company_details')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });

        if (!Schema::connection('job_listings')->hasTable('job_seekers'))
        Schema::connection('job_listings')->create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('seeker_type', ['administrative', 'professional', 'leadership'])->nullable();
            $table->text('bio')->nullable();
            $table->string('cv')->nullable();
            $table->string('phone');
            $table->string('location');
            $table->enum('experience_level', ['entry', 'mid', 'senior', 'executive'])->default('entry');
            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            $table->string('job_title')->nullable();
            $table->decimal('expected_salary_min', 10, 2)->nullable();
            $table->decimal('expected_salary_max', 10, 2)->nullable();
            $table->enum('job_type', ['full_time', 'part_time', 'remote', 'freelance'])->nullable();
            $table->text('about')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->timestamps();
        });

        if (!Schema::connection('job_listings')->hasTable('jobs'))
        Schema::connection('job_listings')->create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('job_main_type', ['leadership', 'professional', 'administrative'])->nullable();
            $table->text('description');
            $table->string('job_category');
            $table->enum('job_type', ['full_time', 'part_time', 'remote', 'freelance', 'training']);
            $table->enum('experience_level', ['entry', 'mid', 'senior', 'executive']);
            $table->string('location');
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->json('required_skills')->nullable();
            $table->json('languages')->nullable();
            $table->integer('positions_available')->default(1);
            $table->text('benefits')->nullable();
            $table->enum('status', ['active', 'closed', 'draft', 'expired'])->default('active');
            $table->timestamp('deadline')->nullable();
            $table->integer('applications_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->timestamps();
        });

        if (!Schema::connection('job_listings')->hasTable('applications'))
        Schema::connection('job_listings')->create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->onDelete('cascade');
            $table->text('cover_letter')->nullable();
            $table->string('cv')->nullable();
            $table->enum('status', ['pending', 'reviewed', 'rejected', 'accepted', 'withdrawn'])->default('pending');
            $table->timestamp('reviewed_at')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });

        if (!Schema::connection('job_listings')->hasTable('reviews'))
        Schema::connection('job_listings')->create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_seeker_id')->constrained('job_seekers')->onDelete('cascade');
            $table->integer('rating');
            $table->text('comment');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        if (!Schema::connection('job_listings')->hasTable('password_reset_tokens'))
        Schema::connection('job_listings')->create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('job_listings')->dropIfExists('reviews');
        Schema::connection('job_listings')->dropIfExists('applications');
        Schema::connection('job_listings')->dropIfExists('jobs');
        Schema::connection('job_listings')->dropIfExists('job_seekers');
        Schema::connection('job_listings')->dropIfExists('companies');
        Schema::connection('job_listings')->dropIfExists('password_reset_tokens');
        Schema::connection('job_listings')->dropIfExists('users');
    }
};
