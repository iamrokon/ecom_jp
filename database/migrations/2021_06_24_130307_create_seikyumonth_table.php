<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeikyumonthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seikyumonth', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->float('nyukinkingaku', 10, 0)->nullable();
			$table->dateTime('shimebi')->nullable();
			$table->float('syouhizei', 10, 0)->nullable();
			$table->string('bikou', 10)->nullable();
			$table->float('kurikoshi', 10, 0)->nullable();
			$table->float('sougaku', 10, 0)->nullable();
			$table->integer('syouhizeikubun')->nullable();
			$table->float('syouhizeiritu', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seikyumonth');
	}

}
