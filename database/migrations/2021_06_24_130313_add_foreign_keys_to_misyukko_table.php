<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMisyukkoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('misyukko', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'misyukko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('seikyubango', 'misyukko_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'misyukko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'misyukko_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'misyukko_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('misyukko', function(Blueprint $table)
		{
			$table->dropForeign('misyukko_orderbango_const');
			$table->dropForeign('misyukko_seikyubango_const');
			$table->dropForeign('misyukko_syouhinbango_const');
			$table->dropForeign('misyukko_syukkosakibango_const');
			$table->dropForeign('misyukko_syukkosoukobango_const');
		});
	}

}
