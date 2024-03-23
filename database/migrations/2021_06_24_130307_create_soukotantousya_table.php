<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoukotantousyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soukotantousya', function(Blueprint $table)
		{
			$table->integer('soukobango')->nullable();
			$table->string('tantousyabango', 20)->nullable();
			$table->integer('ordernumber')->nullable();
			$table->integer('priority')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('soukotantousya');
	}

}
