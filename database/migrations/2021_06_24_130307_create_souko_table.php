<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('souko', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->string('name', 50)->nullable();
			$table->string('shinkurouser', 50)->nullable();
			$table->integer('shinkurosoukobango')->nullable();
			$table->smallInteger('innerlevel')->nullable();
			$table->smallInteger('outerlevel')->nullable();
			$table->string('soukojouhou', 300)->nullable();
			$table->string('credit', 100)->nullable();
			$table->smallInteger('toriokiflag')->nullable()->default(0);
			$table->integer('soukosuchi1')->nullable();
			$table->integer('soukosuchi2')->nullable();
			$table->string('soukomoji1', 50)->nullable();
			$table->string('soukomoji2', 50)->nullable();
			$table->string('shinkurouser2', 50)->nullable();
			$table->integer('shinkurosoukobango2')->nullable();
			$table->integer('shinkurokokyakubango')->nullable();
			$table->integer('shinkurokokyakubango2')->nullable();
			$table->integer('soukosuchi3')->nullable();
			$table->integer('soukosuchi4')->nullable();
			$table->integer('soukosuchi5')->nullable();
			$table->string('soukomoji3', 50)->nullable();
			$table->string('soukomoji4', 50)->nullable();
			$table->string('soukomoji5', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('souko');
	}

}
