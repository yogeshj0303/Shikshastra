<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company-name')->nullable();
            $table->string('logo')->nullable();
            $table->string('departments')->nullable();
            $table->string('location')->nullable();
            $table->string('banner')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->string('founded')->nullable();
            $table->string('headquaters')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
