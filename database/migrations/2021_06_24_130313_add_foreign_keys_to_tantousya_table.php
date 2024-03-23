<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTantousyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tantousya', function(Blueprint $table)
		{
			$table->foreign('innerlevel', 'tantousya_innerlevel_const')->references('level')->on('innerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('outerlevel', 'tantousya_outerlevel_const')->references('level')->on('outerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tantousya', function(Blueprint $table)
		{
			$table->dropForeign('tantousya_innerlevel_const');
			$table->dropForeign('tantousya_outerlevel_const');
		});
	}

}
