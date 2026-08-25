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
         Schema::connection('business')->create('bs_office_specialties', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('office_id');

            $table->unsignedBigInteger('specialty_id');

            $table->timestamps();

            $table->foreign('office_id')
                ->references('id')
                ->on('bs_offices')
                ->onDelete('cascade');

            $table->foreign('specialty_id')
                ->references('id')
                ->on('bs_specialties')
                ->onDelete('cascade');

            $table->unique([
                'office_id',
                'specialty_id'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('business')->dropIfExists('bs_office_specialties');
    }
};
