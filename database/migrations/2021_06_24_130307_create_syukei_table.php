<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyukeiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syukei', function(Blueprint $table)
		{
			$table->string('name', 50)->primary('syukei_pkey');
			$table->float('syukei1', 10, 0)->nullable();
			$table->bigInteger('syukei2')->nullable();
			$table->string('syukei3', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syukei');
	}

}
