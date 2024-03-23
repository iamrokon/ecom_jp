<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSyouhin3Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('syouhin3', function(Blueprint $table)
		{
			$table->foreign('bango', 'syouhin3_bango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('syouhin3', function(Blueprint $table)
		{
			$table->dropForeign('syouhin3_bango_const');
		});
	}

}
