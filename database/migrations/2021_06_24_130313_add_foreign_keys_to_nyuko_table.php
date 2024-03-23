<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNyukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nyuko', function(Blueprint $table)
		{
			$table->foreign('nyukosoukobango', 'nyuko_nyukosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('orderbango', 'nyuko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('shiharaibango', 'nyuko_shiharaibango_const')->references('bango')->on('shiharai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'nyuko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ukeiresakibango', 'nyuko_ukeiresakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nyuko', function(Blueprint $table)
		{
			$table->dropForeign('nyuko_nyukosoukobango_const');
			$table->dropForeign('nyuko_orderbango_const');
			$table->dropForeign('nyuko_shiharaibango_const');
			$table->dropForeign('nyuko_syouhinbango_const');
			$table->dropForeign('nyuko_ukeiresakibango_const');
		});
	}

}
