<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSyouhin2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('syouhin2', function(Blueprint $table)
		{
			$table->foreign('bango', 'syouhin2_bango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('syouhin2', function(Blueprint $table)
		{
			$table->dropForeign('syouhin2_bango_const');
		});
	}

}
