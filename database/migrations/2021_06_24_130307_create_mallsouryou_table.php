<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMallsouryouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mallsouryou', function(Blueprint $table)
		{
			$table->integer('ken')->nullable();
			$table->string('kenmei', 20)->nullable();
			$table->string('areamei', 20)->nullable();
			$table->integer('souryou0')->nullable();
			$table->integer('souryou1')->nullable();
			$table->integer('souryou2')->nullable();
			$table->integer('dataint41')->nullable();
			$table->integer('dataint42')->nullable();
			$table->string('datachar21', 20)->nullable();
			$table->string('datachar22', 20)->nullable();
			$table->string('datachar51', 1000)->nullable();
			$table->string('datachar52', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mallsouryou');
	}

}
