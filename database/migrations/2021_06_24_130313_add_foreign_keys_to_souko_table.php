<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('souko', function(Blueprint $table)
		{
			$table->foreign('innerlevel', 'souko_innerlevel_const')->references('level')->on('innerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('outerlevel', 'souko_outerlevel_const')->references('level')->on('outerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('souko', function(Blueprint $table)
		{
			$table->dropForeign('souko_innerlevel_const');
			$table->dropForeign('souko_outerlevel_const');
		});
	}

}
