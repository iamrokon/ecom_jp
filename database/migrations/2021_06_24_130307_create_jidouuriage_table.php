<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJidouuriageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jidouuriage', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->float('uriagesu', 10, 0)->nullable();
			$table->smallInteger('uriagebi')->nullable();
			$table->integer('kakakutaibango')->nullable();
			$table->integer('haisoubango')->nullable();
			$table->dateTime('nexthaisoudate')->nullable();
			$table->dateTime('keiyakubi')->nullable();
			$table->dateTime('keiyakusyuryoubi')->nullable();
			$table->float('tanka', 10, 0)->nullable();
			$table->smallInteger('furagu')->nullable()->default(0);
			$table->smallInteger('kanryoufuragu')->nullable();
			$table->integer('soukobango')->nullable();
			$table->string('tanabango', 250)->nullable();
			$table->string('tantousya', 20)->nullable();
			$table->integer('yobi1')->nullable();
			$table->integer('yobi2')->nullable();
			$table->integer('yobi3')->nullable();
			$table->integer('yobi4')->nullable();
			$table->integer('yobi5')->nullable();
			$table->string('yobi6', 20)->nullable();
			$table->string('yobi7', 20)->nullable();
			$table->string('yobi8', 20)->nullable();
			$table->string('yobi9', 20)->nullable();
			$table->string('yobi10', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jidouuriage');
	}

}
