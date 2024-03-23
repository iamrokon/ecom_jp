<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEcjuchujyouhouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecjuchujyouhou', function(Blueprint $table)
		{
			$table->dateTime('jyusinjikoku')->nullable();
			$table->string('sitesyubetsu', 100)->nullable();
			$table->string('sitejuchubango', 100)->nullable();
			$table->string('kubun', 100)->nullable();
			$table->string('mailtitle', 100)->nullable();
			$table->string('maildatafile', 100)->nullable();
			$table->string('status', 100)->nullable();
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
		Schema::drop('ecjuchujyouhou');
	}

}
