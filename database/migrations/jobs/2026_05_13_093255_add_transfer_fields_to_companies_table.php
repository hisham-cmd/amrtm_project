<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferFieldsToCompaniesTable extends Migration
{
    protected $connection = 'job_listings';

    public function up()
    {
        Schema::connection('job_listings')->table('companies', function (Blueprint $table) {
            if (!Schema::connection('job_listings')->hasColumn('companies', 'transfer_reasons')) {
                $table->json('transfer_reasons')->nullable()->after('company_type');
            }
            if (!Schema::connection('job_listings')->hasColumn('companies', 'transfer_notes')) {
                $table->text('transfer_notes')->nullable()->after('transfer_reasons');
            }
        });
    }

    public function down()
    {
        Schema::connection('job_listings')->table('companies', function (Blueprint $table) {
            $table->dropColumn(['transfer_reasons', 'transfer_notes']);
        });
    }
}