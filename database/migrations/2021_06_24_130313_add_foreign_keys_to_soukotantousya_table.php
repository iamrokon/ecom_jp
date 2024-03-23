<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSoukotantousyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('soukotantousya', function(Blueprint $table)
		{
			$table->foreign('soukobango', 'soukotantousya_soukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('soukotantousya', function(Blueprint $table)
		{
			$table->dropForeign('soukotantousya_soukobango_const');
		});
	}

}
