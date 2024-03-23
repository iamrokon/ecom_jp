<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeikyuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seikyu', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->float('nyukinkingaku', 10, 0)->nullable();
			$table->dateTime('shimebi')->nullable();
			$table->dateTime('seikyubi')->nullable();
			$table->dateTime('nyukinyoteibi')->nullable();
			$table->float('syouhizei', 10, 0)->nullable();
			$table->string('bikou', 10)->nullable();
			$table->float('kurikoshi', 10, 0)->nullable();
			$table->float('sougaku', 10, 0)->nullable();
			$table->float('dataint01', 10, 0)->nullable();
			$table->float('dataint02', 10, 0)->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seikyu');
	}

}
