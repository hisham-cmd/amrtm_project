<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('franchise_auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('franchise_brands')->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('starting_bid');
            $table->unsignedBigInteger('current_bid');
            $table->unsignedBigInteger('reserve_price')->nullable();
            $table->unsignedBigInteger('increment_amount')->default(2500);
            $table->unsignedBigInteger('deposit_amount')->default(5000);
            $table->unsignedInteger('bids_count')->default(0);
            $table->enum('status', ['upcoming', 'active', 'ended', 'cancelled'])->default('active');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->foreignId('winner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_auctions');
    }
};
