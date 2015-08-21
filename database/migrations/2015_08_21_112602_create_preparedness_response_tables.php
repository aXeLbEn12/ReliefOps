<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreparednessResponseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparedness_response', function (Blueprint $table) {
            $table->increments('report_id');
			$table->string('report_oldname', 200);
            $table->string('report_filename', 150);
			$table->string('status', 50);
            $table->softDeletes();
            $table->timestamps();

            $table->unique('report_filename');
        });
		
        Schema::create('preparedness_response_rows', function (Blueprint $table) {
            $table->increments('row_id');
			$table->integer('report_id');
            $table->string('regionfilter', 200);
			$table->string('region_provincemunicipalitycity', 200);
			$table->string('nhts_pr_2011', 200);
			$table->string('nso_population_2010', 200);
			$table->string('no_of_pantawid_beneficiaries', 200);
            $table->softDeletes();
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
        Schema::drop('preparedness_response');
		Schema::drop('preparedness_response_rows');
    }
}
