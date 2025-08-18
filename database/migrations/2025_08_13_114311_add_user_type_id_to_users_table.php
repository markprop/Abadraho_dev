<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTypeIdToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if the column exists before adding or modifying
            if (!Schema::hasColumn('users', 'user_type_id')) {
                $table->unsignedBigInteger('user_type_id')->after('provider')->nullable();
            }
            // Add foreign key only if user_types table exists
            // if (Schema::hasTable('user_types')) {
            //     $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('set null')->change();
            // }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_type_id']);
            $table->dropColumn('user_type_id');
        });
    }
}