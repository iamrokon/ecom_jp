<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHaisouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('haisou', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->string('name', 1000)->nullable();
			$table->string('yubinbango', 1000)->nullable();
			$table->string('address', 2000)->nullable();
			$table->string('tel', 1000)->nullable()->index();
			$table->string('shikibetsucode', 20)->nullable();
			$table->string('torihikisakibango', 20)->nullable();
			$table->integer('denpyoustart')->nullable();
			$table->integer('denpyouend')->nullable();
			$table->integer('saiban')->nullable();
			$table->string('yobi1', 20)->nullable();
			$table->string('mail', 2000)->nullable();
			$table->string('torihikisakirank1', 20)->nullable();
			$table->string('torihikisakirank2', 20)->nullable();
			$table->integer('haisousuchi1')->nullable();
			$table->integer('haisousuchi2')->nullable();
			$table->string('haisoumoji1', 1000)->nullable();
			$table->string('haisoumoji2', 50)->nullable();
			$table->integer('endtime')->nullable();
			$table->string('netusername', 100)->nullable();
			$table->string('netuserpasswd', 50)->nullable();
			$table->string('netlogin', 20)->nullable();
			$table->float('kounyusu', 10, 0)->nullable();
			$table->float('kingakugoukei', 10, 0)->nullable();
			$table->string('syukeitukikijun', 10)->nullable();
			$table->string('syukeituki', 150)->nullable();
			$table->string('syukeikikijun', 10)->nullable();
			$table->string('syukeiki', 20)->nullable();
			$table->string('syukeinenkijun', 10)->nullable();
			$table->string('syukeinen', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('haisou');
	}

}
