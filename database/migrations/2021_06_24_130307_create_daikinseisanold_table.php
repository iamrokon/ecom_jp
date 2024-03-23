<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDaikinseisanoldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('daikinseisanold', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->integer('synchroorderbango')->nullable();
			$table->integer('shinkurokokyakubango')->nullable();
			$table->string('shinkurokokyakuname', 50)->nullable();
			$table->string('shinkurokokyakugroup', 100)->nullable();
			$table->string('shinkurokokyakuorderbango', 50)->nullable();
			$table->dateTime('torikomidate')->nullable();
			$table->dateTime('chumondate')->nullable();
			$table->dateTime('otodokedate')->nullable();
			$table->string('otodoketime', 20)->nullable();
			$table->dateTime('kanryoubi')->nullable();
			$table->string('kessaihouhou', 20)->nullable();
			$table->float('moneymax', 10, 0)->nullable();
			$table->string('chumonsyaname', 50)->nullable();
			$table->string('soufusakiname', 50)->nullable();
			$table->string('soufusakiyubinbango', 10)->nullable();
			$table->string('unsoumei', 50)->nullable();
			$table->string('toiawasebango', 50)->nullable();
			$table->string('seisanunsoumei', 50)->nullable();
			$table->string('seisankokyakucode', 50)->nullable();
			$table->string('seisankokyakucode2', 50)->nullable();
			$table->dateTime('seisanbi')->nullable();
			$table->dateTime('hassoubi')->nullable();
			$table->dateTime('nyukinbi')->nullable();
			$table->dateTime('nyukinbi2')->nullable();
			$table->dateTime('henpinbi')->nullable();
			$table->string('henpindenpyobango', 50)->nullable();
			$table->string('shiharaikubun', 50)->nullable();
			$table->string('datakubun', 50)->nullable();
			$table->string('teiseikubun', 50)->nullable();
			$table->string('riyouservice', 50)->nullable();
			$table->string('kessaisyudan', 50)->nullable();
			$table->float('nyukingaku', 10, 0)->nullable();
			$table->float('unsoudaibikitesuryou', 10, 0)->nullable();
			$table->float('unsouservicetesuryou', 10, 0)->nullable();
			$table->float('unsousplittesuryou', 10, 0)->nullable();
			$table->float('unsouinshigaku', 10, 0)->nullable();
			$table->float('unsouunchin', 10, 0)->nullable();
			$table->float('henpinunchin', 10, 0)->nullable();
			$table->integer('dataint01')->nullable();
			$table->integer('dataint02')->nullable();
			$table->integer('dataint03')->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 50)->nullable();
			$table->string('datachar03', 50)->nullable();
			$table->dateTime('tourokudate')->nullable();
			$table->dateTime('koushindate')->nullable();
			$table->integer('status')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('daikinseisanold');
	}

}
