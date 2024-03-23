<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDaikinseisanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('daikinseisan', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'daikinseisan_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('daikinseisan', function(Blueprint $table)
		{
			$table->dropForeign('daikinseisan_kokyakubango_const');
		});
	}

}
