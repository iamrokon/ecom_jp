<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->integer('kaiinbango')->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->string('jouhou', 100)->nullable();
			$table->string('color', 100)->nullable();
			$table->string('size', 100)->nullable();
			$table->string('mail', 100)->nullable();
			$table->dateTime('tourokudate')->nullable();
			$table->integer('orderbango')->nullable();
			$table->smallInteger('mobile_flag')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('request');
	}

}
