<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('property_id');
            $table->string('name');
            $table->string('address');
            $table->string('rooms')->nullable();
            $table->unsignedBigInteger('area');
            $table->decimal('latitude', 11, 7);
            $table->decimal('longitude', 11, 7);
            $table->unsignedBigInteger('project_type_id')->nullable();
            $table->string('progress')->nullable();
            $table->string('project_doc')->nullable();
            $table->string('project_video')->nullable();
            $table->string('project_cover_img')->nullable();
            $table->string('project_imgs')->nullable();
            $table->text('details')->nullable();
            $table->decimal('min_price', 65, 8)->default(0);
            $table->integer('installment_length')->nullable();
            $table->integer('status')->default(2); // Default set to Pending
            $table->string('marketed_by')->default('Mark Properties');
            $table->string('slug');
            $table->text('meta-title')->nullable();
            $table->text('meta-description')->nullable();
            $table->text('meta-tags')->nullable();
            $table->dateTime('added_time')->nullable();
            $table->timestamps();
            $table->foreign('project_type_id')->references('id')->on('project_type')->onDelete('cascade');
            $table->foreign('area')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
