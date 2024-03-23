<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoukonyukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soukonyuko', function(Blueprint $table)
		{
			$table->foreign('nyukosoukobango', 'soukonyuko_nyukosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('orderbango', 'soukonyuko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ukeiresakibango', 'soukonyuko_ukeiresakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soukonyuko', function(Blueprint $table)
		{
			$table->dropForeign('soukonyuko_nyukosoukobango_const');
			$table->dropForeign('soukonyuko_orderbango_const');
			$table->dropForeign('soukonyuko_ukeiresakibango_const');
		});
	}

}
