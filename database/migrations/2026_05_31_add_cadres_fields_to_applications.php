<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('applications', function (Blueprint $table) {
        $table->string('country')->nullable();
        $table->string('city')->nullable();
        $table->string('father_name')->nullable();
        $table->string('country_code', 10)->nullable();
        $table->string('work_country')->nullable();
    });
}

public function down(): void
{
    Schema::table('applications', function (Blueprint $table) {
        $table->dropColumn(['country','city','father_name','country_code','work_country']);
    });
}
};
