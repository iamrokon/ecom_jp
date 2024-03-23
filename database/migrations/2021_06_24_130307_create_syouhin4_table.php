<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhin4Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhin4', function(Blueprint $table)
		{
			$table->integer('bango')->primary('syouhin4_pkey');
			$table->string('dspbango', 50)->nullable();
			$table->integer('kokyakubango')->nullable();
			$table->string('keywords', 100)->nullable();
			$table->string('name', 1000)->nullable();
			$table->string('text1', 5000)->nullable();
			$table->string('text2', 5000)->nullable();
			$table->string('text3', 5000)->nullable();
			$table->integer('point')->nullable();
			$table->smallInteger('syuppinflg')->nullable();
			$table->integer('souryou')->nullable();
			$table->string('color', 20)->nullable();
			$table->string('size', 20)->nullable();
			$table->string('syouhingroup', 20)->nullable();
			$table->integer('categorybango')->nullable();
			$table->string('ruijihinbango', 50)->nullable();
			$table->smallInteger('osusumejyuni')->nullable();
			$table->smallInteger('yoyaku')->nullable();
			$table->float('hanbaisu', 10, 0)->nullable();
			$table->dateTime('hanbaikaishi')->nullable();
			$table->dateTime('hanbaisyuryou')->nullable();
			$table->string('chardata1', 20)->nullable();
			$table->string('chardata2', 50)->nullable();
			$table->string('chardata3', 100)->nullable();
			$table->integer('numdata1')->nullable();
			$table->integer('numdata2')->nullable();
			$table->bigInteger('numdata3')->nullable();
			$table->string('text4', 5000)->nullable();
			$table->string('chardata4', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhin4');
	}

}
