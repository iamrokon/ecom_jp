<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFieldlevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fieldlevel', function(Blueprint $table)
		{
			$table->string('name', 50)->primary('fieldlevel_pkey');
			$table->smallInteger('innerlevel')->nullable();
			$table->smallInteger('outerlevel')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fieldlevel');
	}

}
