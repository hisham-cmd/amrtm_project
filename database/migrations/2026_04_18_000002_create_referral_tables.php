<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Unique referral codes per agent
        Schema::create('agent_ref_codes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('users')->cascadeOnDelete();
            $table->string('code', 20)->unique();   // e.g. AGT-7X9K2
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Referral tracking
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('users');
            $table->foreignId('user_id')->constrained('users');   // العميل
            $table->foreignId('hall_id')->constrained('halls');
            $table->foreignId('booking_id')->nullable()->constrained('hall_bookings')->nullOnDelete();
            $table->string('ref_code', 20);
            $table->enum('source', ['link', 'manual'])->default('link');
            $table->decimal('commission_rate', 5, 2)->default(10.00);   // %
            $table->decimal('commission_amount', 10, 2)->nullable();
            $table->enum('status', ['pending', 'confirmed', 'paid', 'rejected'])->default('pending');
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('confirmed_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Prevent duplicate referral for same user+hall
            $table->unique(['user_id', 'hall_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('agent_ref_codes');
    }
};
