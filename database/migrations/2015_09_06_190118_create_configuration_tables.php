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
        Schema::create('configuration', function (Blueprint $table) {
            $table->increments('id');
			$table->string('configuration_name', 200);
			$table->text('configuration_string');
			$table->string('data_table', 200);
			$table->string('status', 50);
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
        Schema::drop('configuration');
    }
}
