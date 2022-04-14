<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientHasReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_has_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->integer('report_type_id');
            $table->longText('img_url');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    // REPORT TYPES
    // 1 - LAB Report
    // 2 - X RAY Report

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_has_reports');
    }
}
