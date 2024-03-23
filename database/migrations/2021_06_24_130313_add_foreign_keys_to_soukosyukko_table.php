<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoukosyukkoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soukosyukko', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'soukosyukko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'soukosyukko_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosoukobango', 'soukosyukko_syukkosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soukosyukko', function(Blueprint $table)
		{
			$table->dropForeign('soukosyukko_orderbango_const');
			$table->dropForeign('soukosyukko_syukkosakibango_const');
			$table->dropForeign('soukosyukko_syukkosoukobango_const');
		});
	}

}
