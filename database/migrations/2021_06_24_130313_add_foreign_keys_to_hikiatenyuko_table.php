<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHikiatenyukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hikiatenyuko', function(Blueprint $table)
		{
			$table->foreign('nyukosoukobango', 'hikiatenyuko_nyukosoukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('shiharaibango', 'hikiatenyuko_shiharaibango_const')->references('bango')->on('shiharai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'hikiatenyuko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ukeiresakibango', 'hikiatenyuko_ukeiresakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hikiatenyuko', function(Blueprint $table)
		{
			$table->dropForeign('hikiatenyuko_nyukosoukobango_const');
			$table->dropForeign('hikiatenyuko_shiharaibango_const');
			$table->dropForeign('hikiatenyuko_syouhinbango_const');
			$table->dropForeign('hikiatenyuko_ukeiresakibango_const');
		});
	}

}
