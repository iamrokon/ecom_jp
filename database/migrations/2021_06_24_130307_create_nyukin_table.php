<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNyukinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nyukin', function(Blueprint $table)
		{
			$table->integer('seikyubango')->nullable();
			$table->dateTime('nyukinbi')->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->integer('shiharaihouhoubango')->nullable();
			$table->integer('kamokucode')->nullable();
			$table->string('kamokuname', 20)->nullable();
			$table->integer('hojocode')->nullable();
			$table->string('hojoname', 20)->nullable();
			$table->string('yobi1', 20)->nullable();
			$table->string('yobi2', 20)->nullable();
			$table->string('yobi3', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nyukin');
	}

}
