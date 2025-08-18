<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('brokers')) {
            Schema::table('brokers', function (Blueprint $table) {
                if (!Schema::hasColumn('brokers', 'contact_person_name')) {
                    $table->string('contact_person_name')->after('id');
                }
                if (!Schema::hasColumn('brokers', 'contact_number')) {
                    $table->string('contact_number')->after('contact_person_name');
                }
                if (!Schema::hasColumn('brokers', 'contact_email')) {
                    $table->string('contact_email')->after('contact_number');
                }
                if (!Schema::hasColumn('brokers', 'company_name')) {
                    $table->string('company_name')->nullable()->after('contact_email');
                }
                if (!Schema::hasColumn('brokers', 'company_address')) {
                    $table->text('company_address')->nullable()->after('company_name');
                }
                if (!Schema::hasColumn('brokers', 'broker_since_years')) {
                    $table->unsignedInteger('broker_since_years')->default(0)->after('company_address');
                }
                if (!Schema::hasColumn('brokers', 'deals_in')) {
                    $table->json('deals_in')->nullable()->after('broker_since_years');
                }
                if (!Schema::hasColumn('brokers', 'created_at')) {
                    $table->timestamps();
                }
            });
        }
    }

    public function down(): void
    {
        // Intentionally no down changes to avoid data loss.
    }
};


