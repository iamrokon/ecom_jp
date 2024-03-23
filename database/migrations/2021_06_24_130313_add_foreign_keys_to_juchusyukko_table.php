<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJuchusyukkoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('juchusyukko', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'juchusyukko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('seikyubango', 'juchusyukko_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'juchusyukko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'juchusyukko_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'juchusyukko_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('juchusyukko', function(Blueprint $table)
		{
			$table->dropForeign('juchusyukko_orderbango_const');
			$table->dropForeign('juchusyukko_seikyubango_const');
			$table->dropForeign('juchusyukko_syouhinbango_const');
			$table->dropForeign('juchusyukko_syukkosakibango_const');
			$table->dropForeign('juchusyukko_syukkosoukobango_const');
		});
	}

}
