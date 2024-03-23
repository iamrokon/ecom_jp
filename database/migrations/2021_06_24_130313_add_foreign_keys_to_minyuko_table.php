<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMinyukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('minyuko', function(Blueprint $table)
		{
			$table->foreign('nyukosoukobango', 'minyuko_nyukosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('orderbango', 'minyuko_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('shiharaibango', 'minyuko_shiharaibango_const')->references('bango')->on('shiharai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'minyuko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ukeiresakibango', 'minyuko_ukeiresakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('minyuko', function(Blueprint $table)
		{
			$table->dropForeign('minyuko_nyukosoukobango_const');
			$table->dropForeign('minyuko_orderbango_const');
			$table->dropForeign('minyuko_shiharaibango_const');
			$table->dropForeign('minyuko_syouhinbango_const');
			$table->dropForeign('minyuko_ukeiresakibango_const');
		});
	}

}
