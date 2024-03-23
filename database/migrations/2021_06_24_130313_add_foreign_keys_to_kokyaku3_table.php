<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKokyaku3Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kokyaku3', function(Blueprint $table)
		{
			$table->foreign('bango', 'kokyaku3_bango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kokyaku3', function(Blueprint $table)
		{
			$table->dropForeign('kokyaku3_bango_const');
		});
	}

}
