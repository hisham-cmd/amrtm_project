<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::connection('business')->create('bs_office_profiles', function (Blueprint $table) {

           $table->unsignedBigInteger('office_id')->unique();

$table->foreign('office_id')
      ->references('id')
      ->on('bs_offices')
      ->onDelete('cascade');

            /*
            |----------------------------------
            | بيانات الترخيص
            |----------------------------------
            */

            $table->string('license_number')->unique();
            $table->string('cr_number')->unique();

            /*
            |----------------------------------
            | بيانات التواصل
            |----------------------------------
            */

            $table->string('mobile')->nullable();

            /*
            |----------------------------------
            | العنوان
            |----------------------------------
            */

            $table->string('country')->nullable();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('office_number')->nullable();

            /*
            |----------------------------------
            | نبذة المكتب
            |----------------------------------
            */

            $table->longText('description_ar')->nullable();
            $table->longText('description_en')->nullable();

            /*
            |----------------------------------
            | بيانات المكتب
            |----------------------------------
            */

            $table->unsignedInteger('handled_cases')->default(0);

            /*
            |----------------------------------
            | التخصص الإضافي
            |----------------------------------
            */

            $table->string('custom_specialty')->nullable();

            /*
            |----------------------------------
            | حالة الملف
            |----------------------------------
            */

            $table->boolean('profile_completed')->default(false);

            $table->enum('verification_status', [
                'draft',
                'pending',
                'approved',
                'rejected'
            ])->default('draft');

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();

            /*
            |----------------------------------
            | QR
            |----------------------------------
            */

            $table->string('office_code')->nullable()->unique();
            $table->string('qr_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('business')->dropIfExists('bs_office_profiles');
    }
};
