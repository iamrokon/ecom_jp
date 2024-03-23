<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZaikoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zaiko', function(Blueprint $table)
		{
			$table->integer('syouhinbango')->nullable()->index();
			$table->integer('soukobango')->nullable();
			$table->string('tanabango', 250)->nullable();
			$table->float('zaikosu', 10, 0)->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->string('yobi1', 20)->nullable();
			$table->string('yobi2', 20)->nullable();
			$table->string('yobi3', 20)->nullable();
			$table->float('zaikometer', 10, 0)->nullable();
			$table->integer('synchrosyouhinbango')->nullable();
			$table->integer('synchrosyouhinbango2')->nullable();
			$table->integer('endtime')->nullable();
			$table->float('dataint01', 10, 0)->nullable();
			$table->float('dataint02', 10, 0)->nullable();
			$table->float('dataint03', 10, 0)->nullable();
			$table->string('datachar01', 20)->nullable();
			$table->string('datachar02', 50)->nullable();
			$table->string('datachar03', 50)->nullable();
			$table->float('dataint04', 10, 0)->nullable();
			$table->float('dataint05', 10, 0)->nullable();
			$table->string('datachar04', 50)->nullable();
			$table->string('datachar05', 50)->nullable();
			$table->float('dataint06', 10, 0)->nullable();
			$table->float('dataint07', 10, 0)->nullable();
			$table->float('dataint08', 10, 0)->nullable();
			$table->float('dataint09', 10, 0)->nullable();
			$table->float('dataint10', 10, 0)->nullable();
			$table->string('datachar06', 1000)->nullable();
			$table->string('datachar07', 1000)->nullable();
			$table->string('datachar08', 1000)->nullable();
			$table->string('datachar09', 1000)->nullable();
			$table->string('datachar10', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zaiko');
	}

}
