<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('title')->nullable();
            $table->string('rooms')->nullable();
            $table->decimal('covered_area', 65, 8)->unsigned()->nullable();
            $table->unsignedBigInteger('measurement_type')->nullable();
            $table->decimal('price', 65, 8)->unsigned();
            $table->decimal('monthly_installment', 65, 8)->unsigned();
            $table->decimal('installment', 65, 8)->unsigned();
            $table->unsignedBigInteger('installment_type')->nullable();
            $table->unsignedBigInteger('unit_type_id');
            $table->decimal('down_payment', 65, 8)->unsigned();
            $table->string('payment_plan_img')->nullable();
            $table->string('floor_plan_img')->nullable();
            $table->text('description')->nullable();
            $table->decimal('loan_amount', 65, 8)->unsigned()->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('measurement_type')->references('id')->on('measurements')->onDelete('cascade');
            $table->foreign('unit_type_id')->references('id')->on('project_type')->onDelete('cascade');
            $table->foreign('installment_type')->references('id')->on('installment_type')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
