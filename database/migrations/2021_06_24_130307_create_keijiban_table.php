<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeijibanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('keijiban', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->integer('etsuransyabango')->nullable();
			$table->integer('keisaikaishibi')->nullable();
			$table->integer('keisaisyuryoubi')->nullable();
			$table->string('naiyou', 1000)->nullable();
			$table->integer('dataint41')->nullable();
			$table->integer('dataint42')->nullable();
			$table->string('datachar21', 50)->nullable();
			$table->string('datachar22', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('keijiban');
	}

}
