<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSoukosyouhinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('soukosyouhin', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->string('name', 50)->nullable();
			$table->string('kokyakusyouhinbango', 100)->nullable();
			$table->string('jouhou', 100)->nullable();
			$table->string('bumon', 50)->nullable();
			$table->string('meker', 50)->nullable();
			$table->string('season', 20)->nullable();
			$table->string('size', 20)->nullable();
			$table->string('kongouritsu', 100)->nullable();
			$table->string('koyuujouhou', 100)->nullable();
			$table->smallInteger('isphoto')->nullable()->default(0);
			$table->smallInteger('iskakaku')->nullable()->default(0);
			$table->smallInteger('isuriage')->nullable()->default(0);
			$table->smallInteger('issyouhin2')->nullable()->default(0);
			$table->string('tokuchou', 100)->nullable();
			$table->string('color', 50)->nullable();
			$table->float('kakaku', 10, 0)->nullable();
			$table->smallInteger('yoyaku')->nullable()->default(0);
			$table->integer('synchrosyouhinbango')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('soukosyouhin');
	}

}
