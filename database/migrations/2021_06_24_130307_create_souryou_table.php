<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSouryouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('souryou', function(Blueprint $table)
		{
			$table->integer('kenid')->nullable();
			$table->string('kenname', 20)->nullable();
			$table->integer('souryou')->nullable();
			$table->integer('kokyakubango')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('souryou');
	}

}
