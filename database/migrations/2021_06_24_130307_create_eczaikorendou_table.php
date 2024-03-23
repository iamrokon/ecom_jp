<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEczaikorendouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eczaikorendou', function(Blueprint $table)
		{
			$table->integer('soukobango')->nullable();
			$table->smallInteger('yukouflag')->nullable();
			$table->smallInteger('bunpaiyukouflag')->nullable();
			$table->string('tsuchimail', 100)->nullable();
			$table->integer('siterank')->nullable();
			$table->string('sitesyubetsu', 100)->nullable();
			$table->string('ftphost', 100)->nullable();
			$table->string('ftpid', 100)->nullable();
			$table->string('ftppw', 100)->nullable();
			$table->string('ftpport', 100)->nullable();
			$table->string('ftppath', 100)->nullable();
			$table->string('bunpaipercent', 10)->nullable();
			$table->integer('kinsyousu')->nullable();
			$table->integer('kinsyousetteisu')->nullable();
			$table->dateTime('saisinjikoku')->nullable();
			$table->string('status', 100)->nullable();
			$table->string('check01', 100)->nullable();
			$table->dateTime('apichecktime')->nullable();
			$table->string('rendoumail', 100)->nullable();
			$table->string('sitename', 100)->nullable();
			$table->dateTime('apitime01')->nullable();
			$table->string('apiid01', 100)->nullable();
			$table->string('apiret01', 100)->nullable();
			$table->dateTime('apitime02')->nullable();
			$table->string('apiid02', 100)->nullable();
			$table->string('apiret02', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eczaikorendou');
	}

}
