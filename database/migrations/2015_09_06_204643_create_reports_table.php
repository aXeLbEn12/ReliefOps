<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('report_id');
			$table->integer('config_id');
			$table->string('incident_name');
			$table->string('incident_number');
			$table->string('status', 50);
			$table->datetime('report_date');
			
            $table->softDeletes();
            $table->timestamps();
            
        });
		
		
        Schema::create('report_file', function (Blueprint $table) {
            $table->increments('file_id');
			$table->integer('report_id');
			
            $table->softDeletes();
            $table->timestamps();
        });
		
        Schema::create('report_file_version', function (Blueprint $table) {
            $table->increments('version_id');
			$table->integer('file_id');
			$table->text('flag_current_version');
            $table->string('report_filename', 150);
			
            $table->softDeletes();
            $table->timestamps();
			//$table->unique('report_filename');
        });
		
		Schema::create('report_file_sheets', function (Blueprint $table) {
            $table->increments('sheet_id');
			$table->integer('version_id');
			$table->integer('worksheet_number');
			$table->text('data_table');
			$table->text('data_table_columns');
			$table->text('excel_info');
			
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
		Schema::drop('reports');
		Schema::drop('report_file');
		Schema::drop('report_file_version');
		Schema::drop('report_file_sheets');
    }
}
