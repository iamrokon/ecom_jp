<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEczaikoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eczaiko', function(Blueprint $table)
		{
			$table->string('shopname', 100)->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->string('shophinban', 50)->nullable();
			$table->float('zaikosu', 10, 0)->nullable();
			$table->integer('rendoflag')->nullable();
			$table->float('rendouzaikosu', 10, 0)->nullable();
			$table->integer('rendoutime')->nullable();
			$table->float('dataint01', 10, 0)->nullable();
			$table->float('dataint02', 10, 0)->nullable();
			$table->float('dataint03', 10, 0)->nullable();
			$table->float('dataint04', 10, 0)->nullable();
			$table->float('dataint05', 10, 0)->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 50)->nullable();
			$table->string('datachar03', 50)->nullable();
			$table->string('datachar04', 50)->nullable();
			$table->string('datachar05', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('eczaiko');
	}

}
