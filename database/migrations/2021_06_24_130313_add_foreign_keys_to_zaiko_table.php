<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToZaikoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('zaiko', function(Blueprint $table)
		{
			$table->foreign('soukobango', 'zaiko_soukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'zaiko_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('zaiko', function(Blueprint $table)
		{
			$table->dropForeign('zaiko_soukobango_const');
			$table->dropForeign('zaiko_syouhinbango_const');
		});
	}

}
