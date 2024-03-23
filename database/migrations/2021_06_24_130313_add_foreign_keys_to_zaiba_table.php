<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToZaibaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('zaiba', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'zaiba_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('tantousyabango', 'zaiba_tantousyabango_const')->references('bango')->on('tantousya')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('zaibatypebango', 'zaiba_zaibatypebango_const')->references('bango')->on('zaibatype')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('zaiba', function(Blueprint $table)
		{
			$table->dropForeign('zaiba_orderbango_const');
			$table->dropForeign('zaiba_tantousyabango_const');
			$table->dropForeign('zaiba_zaibatypebango_const');
		});
	}

}
