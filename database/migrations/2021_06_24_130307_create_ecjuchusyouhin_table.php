<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEcjuchusyouhinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecjuchusyouhin', function(Blueprint $table)
		{
			$table->dateTime('jyusinjikoku')->nullable();
			$table->string('sitesyubetsu', 100)->nullable();
			$table->string('sitejuchubango', 100)->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->integer('juchusu')->nullable();
			$table->string('jidoujyuchukubun', 100)->nullable();
			$table->string('jyuchuzokusei', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ecjuchusyouhin');
	}

}
