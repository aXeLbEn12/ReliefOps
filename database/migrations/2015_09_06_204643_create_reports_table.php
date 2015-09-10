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
		// main table
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('report_id');
			$table->string('report_oldname', 200);
            $table->string('report_filename', 150);
			$table->text('data_table');
			$table->text('data_table_columns');
			$table->text('excel_info');
			$table->string('incident_name');
			$table->string('incident_number');
			$table->datetime('report_date');
			$table->integer('config_id');
			$table->string('status', 50);
			
            $table->softDeletes();
            $table->timestamps();
            $table->unique('report_filename');
        });
		
		// worksheet column
		Schema::create('reports_column', function (Blueprint $table) {
			$table->increments('column_id');
			$table->integer('report_id');
			$table->string('column_name');
			$table->string('cell_number');
			
            $table->softDeletes();
            $table->timestamps();
		});
		
		// worksheet row
		Schema::create('reports_row', function (Blueprint $table) {
			$table->increments('row_id');
			$table->integer('report_id');
			$table->string('row_name');
			$table->string('cell_number');
			
            $table->softDeletes();
            $table->timestamps();
		});
		
		// worksheet
		Schema::create('reports_items', function (Blueprint $table) {
			$table->increments('item_id');
			$table->integer('report_id');
			$table->integer('column_id');
			$table->integer('row_id');
			$table->string('item_name');
			$table->string('cell_number');
			
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
        Schema::drop('reports');
		Schema::drop('reports_column');
		Schema::drop('reports_row');
		Schema::drop('reports_items');
    }
}
