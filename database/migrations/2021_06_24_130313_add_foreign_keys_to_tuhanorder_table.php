<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTuhanorderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tuhanorder', function(Blueprint $table)
		{
			$table->foreign('orderbango', 'tuhanorder_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tuhanorder', function(Blueprint $table)
		{
			$table->dropForeign('tuhanorder_orderbango_const');
		});
	}

}
