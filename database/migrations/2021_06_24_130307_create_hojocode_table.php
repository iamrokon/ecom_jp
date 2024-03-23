<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHojocodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hojocode', function(Blueprint $table)
		{
			$table->integer('code')->nullable();
			$table->string('name', 20)->nullable();
			$table->integer('kamokucode')->nullable();
			$table->integer('yobi1')->nullable();
			$table->string('yobi2', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hojocode');
	}

}
