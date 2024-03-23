<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderhenkanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderhenkan', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->string('kokyakuorderbango', 50)->nullable()->index();
			$table->string('orderuserbango', 20)->nullable();
			$table->dateTime('date')->nullable();
			$table->integer('ordertypebango')->nullable();
			$table->integer('synchroorderbango')->nullable();
			$table->integer('synchroorderbango2')->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 50)->nullable();
			$table->dateTime('deletedate')->nullable();
			$table->string('datachar03', 50)->nullable();
			$table->string('datachar04', 1000)->nullable();
			$table->string('datachar05', 1000)->nullable();
			$table->string('datachar06', 1000)->nullable();
			$table->string('datachar07', 1000)->nullable();
			$table->integer('ordertypebango2')->nullable();
			$table->string('datachar08', 50)->nullable();
			$table->string('datachar09', 50)->nullable();
			$table->string('datachar10', 50)->nullable();
			$table->string('datachar11', 50)->nullable();
			$table->string('datachar12', 50)->nullable();
			$table->string('datachar13', 50)->nullable();
			$table->string('datachar14', 50)->nullable();
			$table->string('datachar15', 50)->nullable();
			$table->integer('intorder01')->nullable();
			$table->integer('intorder02')->nullable();
			$table->integer('intorder03')->nullable();
			$table->integer('intorder04')->nullable();
			$table->integer('intorder05')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orderhenkan');
	}

}
