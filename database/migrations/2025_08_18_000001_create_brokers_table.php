<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('brokers')) {
            Schema::create('brokers', function (Blueprint $table) {
                $table->id();
                $table->string('contact_person_name');
                $table->string('contact_number');
                $table->string('contact_email');
                $table->string('company_name')->nullable();
                $table->text('company_address')->nullable();
                $table->unsignedInteger('broker_since_years')->default(0);
                $table->json('deals_in')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('brokers');
    }
};


