<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('icon')->default('ti-building');
            $table->string('color')->default('#1A237E');
            $table->string('bg')->default('rgba(26,35,126,.1)');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('entities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('icon')->default('ti-building');
            $table->string('color')->default('#1A237E');
            $table->string('bg')->default('rgba(26,35,126,.1)');
            $table->string('tag_ar')->nullable();
            $table->string('tag_en')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('gov_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained()->cascadeOnDelete();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('icon')->default('ti-file-text');
            $table->decimal('price', 10, 2)->default(0);
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('estimated_days')->default(3);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('gov_service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('entity_id')->constrained()->cascadeOnDelete();

            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');
            $table->string('client_id_number');
            $table->string('company_name')->nullable();
            $table->string('company_cr')->nullable();
            $table->text('notes')->nullable();
            $table->json('attachments')->nullable();

            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', ['pending', 'processing', 'in_progress', 'done', 'rejected'])->default('pending');
            $table->text('reject_reason')->nullable();
            $table->string('estimated_completion')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('request_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('service_requests')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('service_payments', function (Blueprint $table) {
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
        Schema::dropIfExists('service_payments');
        Schema::dropIfExists('request_logs');
        Schema::dropIfExists('service_requests');
        Schema::dropIfExists('gov_services');
        Schema::dropIfExists('entities');
        Schema::dropIfExists('categories');
    }
};
