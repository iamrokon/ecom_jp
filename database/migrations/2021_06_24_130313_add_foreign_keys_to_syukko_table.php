<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSyukkoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('syukko', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'syukko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('seikyubango', 'syukko_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'syukko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'syukko_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'syukko_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('syukko', function(Blueprint $table)
		{
			$table->dropForeign('syukko_orderbango_const');
			$table->dropForeign('syukko_seikyubango_const');
			$table->dropForeign('syukko_syouhinbango_const');
			$table->dropForeign('syukko_syukkosakibango_const');
			$table->dropForeign('syukko_syukkosoukobango_const');
		});
	}

}
