<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShiharaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shiharai', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->float('shiharaikingaku', 10, 0)->nullable();
			$table->dateTime('shimebi')->nullable();
			$table->dateTime('shiharaibi')->nullable();
			$table->dateTime('shiharaiyoteibi')->nullable();
			$table->float('syouhizei', 10, 0)->nullable();
			$table->string('bikou', 10)->nullable();
			$table->float('kurikoshi', 10, 0)->nullable();
			$table->float('sougaku', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shiharai');
	}

}
