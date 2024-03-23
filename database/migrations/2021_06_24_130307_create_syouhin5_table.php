<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhin5Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhin5', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->integer('bunseki01')->nullable();
			$table->integer('bunseki02')->nullable();
			$table->integer('bunseki03')->nullable();
			$table->integer('bunseki04')->nullable();
			$table->integer('bunseki05')->nullable();
			$table->integer('bunseki06')->nullable();
			$table->integer('bunseki07')->nullable();
			$table->integer('bunseki08')->nullable();
			$table->integer('bunseki09')->nullable();
			$table->integer('bunseki10')->nullable();
			$table->integer('bunseki11')->nullable();
			$table->integer('bunseki12')->nullable();
			$table->integer('bunseki13')->nullable();
			$table->integer('bunseki14')->nullable();
			$table->integer('bunseki15')->nullable();
			$table->integer('bunseki16')->nullable();
			$table->integer('bunseki17')->nullable();
			$table->integer('bunseki18')->nullable();
			$table->integer('bunseki19')->nullable();
			$table->integer('bunseki20')->nullable();
			$table->string('bunsekichar01', 20)->nullable();
			$table->string('bunsekichar02', 20)->nullable();
			$table->string('bunsekichar03', 50)->nullable();
			$table->string('bunsekichar04', 50)->nullable();
			$table->string('bunsekichar05', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhin5');
	}

}
