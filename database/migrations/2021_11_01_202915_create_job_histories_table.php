<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->bigInteger('job_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('department_id')->references('id')->on('departments');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_histories');
    }
}
