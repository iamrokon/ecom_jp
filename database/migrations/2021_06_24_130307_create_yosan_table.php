<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateYosanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('yosan', function(Blueprint $table)
		{
			$table->string('tantousyabango', 50)->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('season')->nullable();
			$table->integer('nengetsu')->nullable();
			$table->integer('weeks')->nullable();
			$table->float('yosan', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('yosan');
	}

}
