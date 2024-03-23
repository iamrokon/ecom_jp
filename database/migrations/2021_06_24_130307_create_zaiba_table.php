<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZaibaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zaiba', function(Blueprint $table)
		{
			$table->string('tantousyabango', 20)->nullable();
			$table->integer('orderbango')->nullable();
			$table->integer('zaibatypebango')->nullable();
			$table->integer('zaibajikan')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('zaiba');
	}

}
