<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEtsuransyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('etsuransya', function(Blueprint $table)
		{
			$table->foreign('innerlevel', 'etsuransya_innerlevel_const')->references('level')->on('innerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kokyakubango', 'etsuransya_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('outerlevel', 'etsuransya_outerlevel_const')->references('level')->on('outerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('etsuransya', function(Blueprint $table)
		{
			$table->dropForeign('etsuransya_innerlevel_const');
			$table->dropForeign('etsuransya_kokyakubango_const');
			$table->dropForeign('etsuransya_outerlevel_const');
		});
	}

}
