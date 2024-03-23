<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSyukkinTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('syukkin', function(Blueprint $table)
		{
			$table->foreign('shiharaibango', 'syukkin_shiharaibango_const')->references('bango')->on('shiharai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('shiharaihouhoubango', 'syukkin_shiharaihouhoubango_const')->references('bango')->on('shiharaihouhou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('syukkin', function(Blueprint $table)
		{
			$table->dropForeign('syukkin_shiharaibango_const');
			$table->dropForeign('syukkin_shiharaihouhoubango_const');
		});
	}

}
