<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'job_listings';

    public function up(): void
    {
        if (Schema::connection('job_listings')->hasColumn('job_seekers', 'desired_specialization')) {
            return;
        }

        Schema::connection('job_listings')->table('job_seekers', function (Blueprint $table) {
            $table->string('desired_specialization')->nullable()->after('seeker_type');
        });
    }

    public function down(): void
    {
        Schema::connection('job_listings')->table('job_seekers', function (Blueprint $table) {
            $table->dropColumn('desired_specialization');
        });
    }
};
