<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sender_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type')->default('info'); // status_update, admin_note, info_request, request_submitted
            $table->string('title');
            $table->text('body');
            $table->foreignId('request_id')->nullable()->constrained('service_requests')->cascadeOnDelete();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        Schema::table('request_logs', function (Blueprint $table) {
            $table->string('log_type')->default('status_change')->after('status');
            // log_type: status_change, admin_note, info_request, user_note
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('business_notifications');
        Schema::table('request_logs', function (Blueprint $table) {
            $table->dropColumn('log_type');
        });
    }
};
