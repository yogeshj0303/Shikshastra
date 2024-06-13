<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->string('company_id')->nullable();
            $table->string('company_name')->nullable();
            $table->string('job_type')->nullable();
            $table->string('job_description')->nullable();
            $table->string('location_available')->nullable();
            $table->string('salery')->nullable();
            $table->string('skills')->nullable();
            $table->string('banner')->nullable();

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
        Schema::dropIfExists('jobs');
    }
}
