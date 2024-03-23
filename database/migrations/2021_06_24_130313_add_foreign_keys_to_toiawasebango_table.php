<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToToiawasebangoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('toiawasebango', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'toiawasebango_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'toiawasebango_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('toiawasebango', function(Blueprint $table)
		{
			$table->dropForeign('toiawasebango_orderbango_const');
			$table->dropForeign('toiawasebango_syukkosakibango_const');
		});
	}

}
