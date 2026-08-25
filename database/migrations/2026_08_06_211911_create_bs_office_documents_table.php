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
        Schema::connection('business')->create('bs_office_documents', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('office_id');

            $table->enum('document_type', [
                'license',
                'commercial_register',
                'cv',
                'certificate',
                'award',
                'client',
                'experience'
            ]);

            $table->string('file');

            $table->string('file_name')->nullable();

            $table->boolean('is_verified')->default(false);

            $table->timestamps();

            $table->foreign('office_id')
                ->references('id')
                ->on('bs_offices')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bs_office_documents');
    }
};
