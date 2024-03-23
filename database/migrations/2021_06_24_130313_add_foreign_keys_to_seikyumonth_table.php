<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeikyumonthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seikyumonth', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'seikyumonth_bango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seikyumonth', function(Blueprint $table)
		{
			$table->dropForeign('seikyumonth_bango_const');
		});
	}

}
