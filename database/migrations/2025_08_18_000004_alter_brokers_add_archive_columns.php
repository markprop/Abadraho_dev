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
                if (!Schema::hasColumn('brokers', 'is_active')) {
                    $table->tinyInteger('is_active')->default(1)->after('deals_in');
                }
                if (!Schema::hasColumn('brokers', 'is_archive')) {
                    $table->tinyInteger('is_archive')->default(0)->after('is_active');
                }
                if (!Schema::hasColumn('brokers', 'is_archive_by')) {
                    $table->unsignedBigInteger('is_archive_by')->nullable()->after('is_archive');
                }
                if (!Schema::hasColumn('brokers', 'is_archive_at')) {
                    $table->dateTime('is_archive_at')->nullable()->after('is_archive_by');
                }
            });
        }
    }

    public function down(): void
    {
        // No down to avoid data loss.
    }
};


