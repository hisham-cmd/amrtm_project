<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hall_bookings', function (Blueprint $table) {
            $table->string('payment_method', 30)->nullable()->after('total_price');
            $table->string('payment_contact', 30)->nullable()->after('payment_method');
            $table->string('payment_email')->nullable()->after('payment_contact');
            $table->string('payment_reference', 100)->nullable()->after('payment_email');
            $table->string('payment_status', 20)->default('pending')->after('payment_reference');
        });
    }

    public function down(): void
    {
        Schema::table('hall_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_contact',
                'payment_email',
                'payment_reference',
                'payment_status',
            ]);
        });
    }
};