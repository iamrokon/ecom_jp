<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEcsyouhinjyouhouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ecsyouhinjyouhou', function(Blueprint $table)
		{
			$table->integer('syouhinbango')->nullable();
			$table->string('sitesyubetsu', 100)->nullable();
			$table->string('sitehinban', 100)->nullable();
			$table->smallInteger('yukouflag')->nullable();
			$table->string('bunpaipercent', 10)->nullable();
			$table->integer('kinsyousu')->nullable();
			$table->integer('kinsyousetteisu')->nullable();
			$table->dateTime('saisinjikoku')->nullable();
			$table->integer('kousinzaikosu')->nullable();
			$table->string('status', 1000)->nullable();
			$table->string('check01', 1000)->nullable();
			$table->integer('kakuhosu')->nullable();
			$table->integer('leadtime')->nullable();
			$table->smallInteger('jidoujuchuflag')->nullable();
			$table->smallInteger('yoyakuflag')->nullable();
			$table->integer('yoyakusaidaisu')->nullable();
			$table->integer('yoyakuhanbaisu')->nullable();
			$table->string('hanbaimode', 100)->nullable();
			$table->string('syouhinzokusei', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ecsyouhinjyouhou');
	}

}
