<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJuchusyukko2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('juchusyukko2', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'juchusyukko2_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('seikyubango', 'juchusyukko2_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'juchusyukko2_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'juchusyukko2_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'juchusyukko2_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('juchusyukko2', function(Blueprint $table)
		{
			$table->dropForeign('juchusyukko2_orderbango_const');
			$table->dropForeign('juchusyukko2_seikyubango_const');
			$table->dropForeign('juchusyukko2_syouhinbango_const');
			$table->dropForeign('juchusyukko2_syukkosakibango_const');
			$table->dropForeign('juchusyukko2_syukkosoukobango_const');
		});
	}

}
