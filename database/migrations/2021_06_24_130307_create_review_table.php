<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('review', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->integer('kaiinbango')->nullable();
			$table->string('nickname', 100)->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->string('kokyakusyouhinbango', 100)->nullable();
			$table->string('jouhou', 100)->nullable();
			$table->string('color', 100)->nullable();
			$table->string('size', 100)->nullable();
			$table->string('message', 600)->nullable();
			$table->dateTime('tourokudate')->nullable();
			$table->dateTime('koushindate')->nullable();
			$table->integer('orderbango')->nullable();
			$table->smallInteger('mobile_flag')->nullable();
			$table->smallInteger('check_flag')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('review');
	}

}
