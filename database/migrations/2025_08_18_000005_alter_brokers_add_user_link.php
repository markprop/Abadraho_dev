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
                if (!Schema::hasColumn('brokers', 'user_id')) {
                    $table->unsignedBigInteger('user_id')->nullable()->after('id');
                }
                if (!Schema::hasColumn('brokers', 'password')) {
                    $table->string('password')->nullable()->after('contact_email');
                }
            });
        }
    }

    public function down(): void
    {
        // no down to avoid data-loss
    }
};


