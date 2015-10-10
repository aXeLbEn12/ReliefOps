<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		// configuration table
        /*Schema::create('configuration', function (Blueprint $table) {
            $table->increments('config_id');
			$table->string('configuration_name', 200);
			$table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
		
		// spreadsheet here
        Schema::create('configuration_sheet', function (Blueprint $table) {
            $table->increments('sheet_id');
			$table->integer('config_id');
			$table->text('sheet_name');
			//$table->text('sheet_number');
			$table->text('configuration_string');
			$table->text('data_table');
			$table->text('data_table_columns');
            $table->softDeletes();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::drop('configuration');
		Schema::drop('configuration_sheet');*/
    }
}
