<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDaikinseisanoldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('daikinseisanold', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'daikinseisanold_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('daikinseisanold', function(Blueprint $table)
		{
			$table->dropForeign('daikinseisanold_kokyakubango_const');
		});
	}

}
