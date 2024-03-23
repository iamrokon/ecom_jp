<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHikiatesyukko2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hikiatesyukko2', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'hikiatesyukko2_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('seikyubango', 'hikiatesyukko2_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'hikiatesyukko2_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'hikiatesyukko2_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'hikiatesyukko2_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hikiatesyukko2', function(Blueprint $table)
		{
			$table->dropForeign('hikiatesyukko2_orderbango_const');
			$table->dropForeign('hikiatesyukko2_seikyubango_const');
			$table->dropForeign('hikiatesyukko2_syouhinbango_const');
			$table->dropForeign('hikiatesyukko2_syukkosakibango_const');
			$table->dropForeign('hikiatesyukko2_syukkosoukobango_const');
		});
	}

}
