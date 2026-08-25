<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // These tables live in the 'business' database connection
    protected $connection = 'business';

    public function up(): void
    {
        // bs_requests: most queried table — filter by user_id, status, and date
        Schema::connection('business')->table('bs_requests', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('status');
            $table->index(['user_id', 'status']);
            $table->index(['status', 'created_at']);
        });

        // bs_payments: wallet balance queries filter by user_id and type
        Schema::connection('business')->table('bs_payments', function (Blueprint $table) {
            $table->index('user_id');
            $table->index(['user_id', 'type']);
        });

        // bs_notifications: unread count queries filter by user_id + is_read
        Schema::connection('business')->table('bs_notifications', function (Blueprint $table) {
            $table->index(['user_id', 'is_read']);
        });
    }

    public function down(): void
    {
        Schema::connection('business')->table('bs_requests', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status', 'created_at']);
        });

        Schema::connection('business')->table('bs_payments', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['user_id', 'type']);
        });

        Schema::connection('business')->table('bs_notifications', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'is_read']);
        });
    }
};
