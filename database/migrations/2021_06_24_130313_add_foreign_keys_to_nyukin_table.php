<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNyukinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nyukin', function(Blueprint $table)
		{
			$table->foreign('seikyubango', 'nyukin_seikyubango_const')->references('bango')->on('seikyu')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('shiharaihouhoubango', 'nyukin_shiharaihouhoubango_const')->references('bango')->on('shiharaihouhou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nyukin', function(Blueprint $table)
		{
			$table->dropForeign('nyukin_seikyubango_const');
			$table->dropForeign('nyukin_shiharaihouhoubango_const');
		});
	}

}
