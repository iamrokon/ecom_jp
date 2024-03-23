<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInclementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inclement', function(Blueprint $table)
		{
			$table->string('serial_id', 8)->nullable();
			$table->bigInteger('max_no')->nullable();
			$table->dateTime('last_req')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('inclement');
	}

}
