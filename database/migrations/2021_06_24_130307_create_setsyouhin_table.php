<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSetsyouhinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('setsyouhin', function(Blueprint $table)
		{
			$table->string('name', 100)->nullable();
			$table->float('setsu', 10, 0)->nullable();
			$table->integer('setbango')->nullable();
			$table->float('syoyousu', 10, 0)->nullable();
			$table->string('setsyouhin', 5000)->nullable();
			$table->float('kakaku', 10, 0)->nullable();
			$table->float('kakaku2', 10, 0)->nullable();
			$table->float('kakaku3', 10, 0)->nullable();
			$table->string('name2', 100)->nullable();
			$table->string('name3', 100)->nullable();
			$table->string('name4', 100)->nullable();
			$table->string('name5', 100)->nullable();
			$table->string('setsyouhin2', 5000)->nullable();
			$table->string('setsyouhin3', 5000)->nullable();
			$table->float('kakaku4', 10, 0)->nullable();
			$table->float('kakaku5', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('setsyouhin');
	}

}
