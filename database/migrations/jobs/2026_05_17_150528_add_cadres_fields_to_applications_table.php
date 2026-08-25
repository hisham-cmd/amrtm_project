<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'application_type')) {
                $table->enum('application_type', ['job', 'cadres'])->default('job');
            }
            
            if (!Schema::hasColumn('applications', 'first_name')) {
                $table->string('first_name')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'last_name')) {
                $table->string('last_name')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'birth_date')) {
                $table->date('birth_date')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'gender')) {
                $table->enum('gender', ['male', 'female'])->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'phone')) {
                $table->string('phone')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'email')) {
                $table->string('email')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'nationality')) {
                $table->string('nationality')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'passport_number')) {
                $table->string('passport_number')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'passport_expiry')) {
                $table->date('passport_expiry')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'passport_country')) {
                $table->string('passport_country')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'photo')) {
                $table->string('photo')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'certificate')) {
                $table->string('certificate')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'education_level')) {
                $table->enum('education_level', [
                    'high_school', 'diploma', 'bachelor', 'master', 'phd', 'other'
                ])->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'specialization')) {
                $table->string('specialization')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'origin_country')) {
                $table->string('origin_country')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'target_countries')) {
                $table->json('target_countries')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'job_title_desired')) {
                $table->string('job_title_desired')->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'desired_job_type')) {
                $table->enum('desired_job_type', [
                    'full_time', 'part_time', 'remote', 'freelance'
                ])->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'expected_salary_min')) {
                $table->decimal('expected_salary_min', 10, 2)->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'expected_salary_max')) {
                $table->decimal('expected_salary_max', 10, 2)->nullable();
            }
            
            if (!Schema::hasColumn('applications', 'notes')) {
                $table->text('notes')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $columns = [
                'application_type',
                'first_name', 'last_name', 'birth_date', 'gender',
                'phone', 'email', 'nationality',
                'passport_number', 'passport_expiry', 'passport_country',
                'photo', 'certificate', 'education_level', 'specialization',
                'origin_country', 'target_countries', 'job_title_desired',
                'desired_job_type', 'expected_salary_min', 'expected_salary_max',
                'notes',
            ];
            
            // احذف فقط الأعمدة الموجودة
            foreach ($columns as $column) {
                if (Schema::hasColumn('applications', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};