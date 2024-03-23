<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKamokuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kamoku', function(Blueprint $table)
		{
			$table->integer('code')->primary('kamoku_pkey');
			$table->string('name', 20)->nullable();
			$table->string('tekiou', 20)->nullable();
			$table->string('hantei', 20)->nullable();
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
		Schema::drop('kamoku');
	}

}
