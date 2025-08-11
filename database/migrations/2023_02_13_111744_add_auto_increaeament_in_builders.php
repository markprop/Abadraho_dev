<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoIncreaeamentInBuilders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('builders', function (Blueprint $table) {
        //     $table->primary('id');
        // });

        // Schema::table('builders', function (Blueprint $table) {
        //     $table->bigIncrements('id', true)->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('builders', function (Blueprint $table) {
            //
        });
    }
}
