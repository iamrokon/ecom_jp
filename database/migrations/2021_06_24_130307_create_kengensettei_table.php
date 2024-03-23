<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKengensetteiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kengensettei', function(Blueprint $table)
		{
			$table->string('kengenchar01', 50)->nullable();
			$table->string('kengenchar02', 50)->nullable();
			$table->string('kengenchar03', 50)->nullable();
			$table->string('kengenchar04', 5000)->nullable();
			$table->string('kengenchar05', 5000)->nullable();
			$table->string('kengenchar06', 5000)->nullable();
			$table->string('kengenchar07', 5000)->nullable();
			$table->dateTime('kengendate01')->nullable();
			$table->dateTime('kengendate02')->nullable();
			$table->dateTime('kengendate03')->nullable();
			$table->float('kengenint01', 10, 0)->nullable();
			$table->float('kengenint02', 10, 0)->nullable();
			$table->float('kengenint03', 10, 0)->nullable();
			$table->float('kengenint04', 10, 0)->nullable();
			$table->float('kengenint05', 10, 0)->nullable();
			$table->integer('kengenint06')->nullable();
			$table->integer('kengenint07')->nullable();
			$table->integer('kengenint08')->nullable();
			$table->integer('kengenint09')->nullable();
			$table->integer('kengenint10')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kengensettei');
	}

}
