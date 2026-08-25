<?php
// database/migrations/2025_01_01_000003_create_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number')->unique();  // AMR-XXXXXX
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('entity_id')->constrained()->cascadeOnDelete();

            // Client info (snapshot at time of request)
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_id_number');
            $table->string('company_name')->nullable();
            $table->string('company_cr')->nullable();
            $table->text('notes')->nullable();
            $table->json('attachments')->nullable();   // file paths array

            // Status & pricing
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', [
                'pending',
                'processing',
                'in_progress',
                'done',
                'rejected'
            ])->default('pending');

            // Admin fields
            $table->text('reject_reason')->nullable();
            $table->string('estimated_completion')->nullable();  // e.g. "3-5 أيام عمل"
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();
        });

        // Status change log
        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('service_requests')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // Payments / wallet
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('request_id')->nullable()->constrained('service_requests')->nullOnDelete();
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['charge', 'payment', 'refund'])->default('charge');
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('completed');
            $table->string('transaction_ref')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('request_logs');
        Schema::dropIfExists('service_requests');
    }
};
