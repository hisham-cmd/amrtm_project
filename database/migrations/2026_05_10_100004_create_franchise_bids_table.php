<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('franchise_bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auction_id')->constrained('franchise_auctions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedBigInteger('amount');
            $table->enum('status', ['active', 'outbid', 'won', 'refunded'])->default('active');
            $table->string('deposit_ref')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_bids');
    }
};
