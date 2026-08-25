<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('supervisor_partners', function (Blueprint $table) {
            $table->string('description', 255)->nullable()->after('company_name');
            $table->string('phone', 20)->nullable()->after('description');
            $table->string('whatsapp', 20)->nullable()->after('phone');
            $table->string('price', 100)->nullable()->after('whatsapp');
            $table->text('offers')->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('supervisor_partners', function (Blueprint $table) {
            $table->dropColumn(['description', 'phone', 'whatsapp']);
        });
    }
};
