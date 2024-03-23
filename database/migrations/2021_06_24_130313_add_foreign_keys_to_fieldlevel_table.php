<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFieldlevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fieldlevel', function(Blueprint $table)
		{
			$table->foreign('innerlevel', 'fieldlevel_innerlevel_const')->references('level')->on('innerrank')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('outerlevel', 'fieldlevel_outerlevel_const')->references('level')->on('outerrank')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fieldlevel', function(Blueprint $table)
		{
			$table->dropForeign('fieldlevel_innerlevel_const');
			$table->dropForeign('fieldlevel_outerlevel_const');
		});
	}

}
