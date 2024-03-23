<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGazouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gazou', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->integer('syouhinbango')->nullable()->index();
			$table->smallInteger('hantei')->nullable();
			$table->string('url', 300)->nullable();
			$table->string('setumei', 5000)->nullable();
			$table->string('catch', 5000)->nullable();
			$table->string('caption', 5000)->nullable();
			$table->string('urlsm', 300)->nullable();
			$table->string('catchsm', 1000)->nullable();
			$table->string('mbcatch', 1000)->nullable();
			$table->string('mbcatchsm', 200)->nullable();
			$table->string('mbcaption', 200)->nullable();
			$table->smallInteger('hyouji')->nullable();
			$table->smallInteger('saitocode')->nullable();
			$table->smallInteger('hyoujijyun')->nullable();
			$table->string('datatxt0096', 1000)->nullable();
			$table->string('datatxt0097', 1000)->nullable();
			$table->string('datatxt0098', 1000)->nullable();
			$table->string('datatxt0099', 1000)->nullable();
			$table->string('datatxt0100', 1000)->nullable();
			$table->string('datatxt0101', 1000)->nullable();
			$table->string('datatxt0102', 1000)->nullable();
			$table->string('datatxt0103', 1000)->nullable();
			$table->string('datatxt0104', 1000)->nullable();
			$table->string('datatxt0105', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('gazou');
	}

}
