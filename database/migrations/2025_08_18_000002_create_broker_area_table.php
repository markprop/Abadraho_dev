<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('broker_area')) {
            Schema::create('broker_area', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('broker_id');
                $table->unsignedBigInteger('area_id');
                $table->timestamps();

                $table->foreign('broker_id')->references('id')->on('brokers')->onDelete('cascade');
                $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
                $table->unique(['broker_id', 'area_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('broker_area');
    }
};


