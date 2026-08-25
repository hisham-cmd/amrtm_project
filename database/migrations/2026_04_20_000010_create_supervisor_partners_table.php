<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supervisor_partners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('category_id');
            $table->string('company_name', 150);
            $table->string('logo_path')->nullable();
            $table->timestamps();

            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('partner_categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supervisor_partners');
    }
};