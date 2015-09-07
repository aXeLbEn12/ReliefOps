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
			$table->string('report_oldname', 200);
            $table->string('report_filename', 150);
			$table->text('data_table');
			$table->text('excel_info');
			$table->integer('config_id');
			$table->string('status', 50);
            $table->softDeletes();
            $table->timestamps();

            $table->unique('report_filename');
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
    }
}
