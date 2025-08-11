<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("vouchers", function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->after('id');
            $table->string('name')->after('code');
            $table->enum('discount_applied', ['project', 'unit'])->after('name');
            $table->enum('discount_by', ['amount', 'percentage'])->after('discount_applied');
            $table->string('discount_value')->after('discount_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("vouchers", function (Blueprint $table) {
            $table->dropColumn('project_id');
            $table->dropColumn('name');
            $table->dropColumn('discount_by');
            $table->dropColumn('discount_applied');
            $table->dropColumn('discount_value');
        });
    }
}
