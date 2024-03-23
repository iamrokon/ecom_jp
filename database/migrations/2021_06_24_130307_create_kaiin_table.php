<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKaiinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kaiin', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->string('mail', 100)->nullable()->index();
			$table->string('name', 100)->nullable();
			$table->string('kaka', 100)->nullable();
			$table->string('sex', 10)->nullable();
			$table->string('yubinbango', 10)->nullable();
			$table->string('kenadd', 10)->nullable();
			$table->string('ciadd', 20)->nullable();
			$table->string('cyouadd', 50)->nullable();
			$table->string('biladd', 50)->nullable();
			$table->string('tel', 15)->nullable();
			$table->dateTime('birthday')->nullable();
			$table->string('nickname', 100)->nullable();
			$table->string('passwd', 50)->nullable();
			$table->smallInteger('mailflagu')->nullable();
			$table->string('model', 50)->nullable();
			$table->string('carrier', 50)->nullable();
			$table->string('terminal', 100)->nullable()->index();
			$table->integer('point')->nullable();
			$table->float('kounyusu', 10, 0)->nullable();
			$table->float('kingakugoukei', 10, 0)->nullable();
			$table->string('syukeitukikijun', 10)->nullable();
			$table->string('syukeituki', 150)->nullable();
			$table->string('syukeikikijun', 10)->nullable();
			$table->string('syukeiki', 20)->nullable();
			$table->string('syukeinenkijun', 10)->nullable();
			$table->string('syukeinen', 10)->nullable();
			$table->integer('starttime')->nullable();
			$table->integer('endtime')->nullable();
			$table->string('bunrui1', 50)->nullable();
			$table->string('bunrui2', 50)->nullable();
			$table->float('syukei1', 10, 0)->nullable();
			$table->float('syukei2', 10, 0)->nullable();
			$table->float('syukei3', 10, 0)->nullable();
			$table->float('syukei4', 10, 0)->nullable();
			$table->float('syukei5', 10, 0)->nullable();
			$table->string('address', 200)->nullable();
			$table->integer('pointlimit')->nullable();
			$table->integer('kokyakubango')->nullable();
			$table->integer('lastusepoint')->nullable();
			$table->integer('lastbuy')->nullable();
			$table->string('mail2', 100)->nullable();
			$table->string('text1', 1000)->nullable();
			$table->string('text2', 1000)->nullable();
			$table->string('text3', 1000)->nullable();
			$table->string('text4', 1000)->nullable();
			$table->string('text5', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kaiin');
	}

}
