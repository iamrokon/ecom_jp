<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTushindatTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tushindat', function(Blueprint $table)
		{
			$table->float('datanum0003', 10, 0)->nullable();
			$table->float('datanum0004', 10, 0)->nullable();
			$table->float('datanum0005', 10, 0)->nullable();
			$table->float('datanum0006', 10, 0)->nullable();
			$table->float('datanum0007', 10, 0)->nullable();
			$table->string('datatxt0009')->nullable();
			$table->string('datatxt0010')->nullable();
			$table->string('datatxt0011')->nullable();
			$table->string('datatxt0012')->nullable();
			$table->string('datatxt0013')->nullable();
			$table->string('datatushin01', 8000)->nullable();
			$table->string('datatushin02', 8000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tushindat');
	}

}
