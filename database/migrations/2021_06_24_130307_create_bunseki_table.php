<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBunsekiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bunseki', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->string('fieldname', 20)->nullable();
			$table->integer('bunsekibango')->nullable();
			$table->string('name', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bunseki');
	}

}
