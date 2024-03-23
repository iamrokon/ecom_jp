<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShinkurohaisouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shinkurohaisou', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('shinkurohaisoubango')->nullable();
			$table->integer('shinkurohaisoubango2')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shinkurohaisou');
	}

}
