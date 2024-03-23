<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHikiatesyukkoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hikiatesyukko', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'hikiatesyukko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('seikyubango', 'hikiatesyukko_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'hikiatesyukko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'hikiatesyukko_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'hikiatesyukko_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hikiatesyukko', function(Blueprint $table)
		{
			$table->dropForeign('hikiatesyukko_orderbango_const');
			$table->dropForeign('hikiatesyukko_seikyubango_const');
			$table->dropForeign('hikiatesyukko_syouhinbango_const');
			$table->dropForeign('hikiatesyukko_syukkosakibango_const');
			$table->dropForeign('hikiatesyukko_syukkosoukobango_const');
		});
	}

}
