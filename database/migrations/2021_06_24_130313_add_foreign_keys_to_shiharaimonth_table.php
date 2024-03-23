<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShiharaimonthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shiharaimonth', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'shiharaimonth_bango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shiharaimonth', function(Blueprint $table)
		{
			$table->dropForeign('shiharaimonth_bango_const');
		});
	}

}
