<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKokyakusoukoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kokyakusouko', function(Blueprint $table)
		{
			$table->foreign('soukobango', 'kokaykusouko_soukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kokyakusouko', function(Blueprint $table)
		{
			$table->dropForeign('kokaykusouko_soukobango_const');
		});
	}

}
