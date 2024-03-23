<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardinformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cardinformation', function(Blueprint $table)
		{
			$table->integer('orderbango')->nullable();
			$table->integer('haisoubango')->nullable();
			$table->string('customername', 100)->nullable();
			$table->string('cardname', 20)->nullable();
			$table->string('cardownername', 100)->nullable();
			$table->string('cardnum', 50)->nullable();
			$table->string('kigen', 10)->nullable();
			$table->string('kaisu', 20)->nullable();
			$table->string('houhou', 20)->nullable();
			$table->smallInteger('yoshin')->nullable();
			$table->integer('yoshinkekka')->nullable();
			$table->string('chuui', 20)->nullable();
			$table->integer('numdata1')->nullable();
			$table->string('chardata1', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cardinformation');
	}

}
