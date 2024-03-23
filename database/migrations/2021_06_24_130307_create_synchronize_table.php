<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSynchronizeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('synchronize', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->integer('kokyakubango2')->nullable();
			$table->string('synchronizeusername', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('synchronize');
	}

}
