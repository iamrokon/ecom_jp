<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtsurankokyakuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etsurankokyaku', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->integer('kokyakubango')->nullable();
			$table->integer('kakakutaibango')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etsurankokyaku');
	}

}
