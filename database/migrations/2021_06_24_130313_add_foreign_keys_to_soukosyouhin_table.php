<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoukosyouhinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soukosyouhin', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'soukosyouhin_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soukosyouhin', function(Blueprint $table)
		{
			$table->dropForeign('soukosyouhin_kokyakubango_const');
		});
	}

}
