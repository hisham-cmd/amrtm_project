<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officiants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();

            // Professional info
            $table->string('license_number', 60)->nullable();
            $table->string('working_hours', 100)->nullable();
            $table->string('bank_account', 60)->nullable();
            $table->string('iban', 34)->nullable();

            // Location
            $table->string('city', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('phone', 20)->nullable();

            // Manager / representative info (mirrors hall & partner pattern)
            $table->string('manager_first_name', 60)->nullable();
            $table->string('manager_father_name', 60)->nullable();
            $table->string('manager_grandfather_name', 60)->nullable();
            $table->string('manager_phone', 20)->nullable();
            $table->string('rep_first_name', 60)->nullable();
            $table->string('rep_father_name', 60)->nullable();
            $table->string('rep_grandfather_name', 60)->nullable();

            $table->enum('status', ['pending', 'active', 'rejected'])->default('pending');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });

        // Remove officiant-specific columns that were temporarily added to partners
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn([
                'officiant_license_number',
                'officiant_working_hours',
                'officiant_bank_account',
                'officiant_iban',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officiants');

        Schema::table('partners', function (Blueprint $table) {
            $table->string('officiant_license_number', 60)->nullable();
            $table->string('officiant_working_hours', 100)->nullable();
            $table->string('officiant_bank_account', 60)->nullable();
            $table->string('officiant_iban', 34)->nullable();
        });
    }
};
