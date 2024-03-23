<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSyouhin1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('syouhin1', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'syouhin1_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('syouhin1', function(Blueprint $table)
		{
			$table->dropForeign('syouhin1_kokyakubango_const');
		});
	}

}
