<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHaisoujouhouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('haisoujouhou', function(Blueprint $table)
		{
			$table->foreign('haisoubango', 'haisoujouhou_haisoubango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('haisoujouhou', function(Blueprint $table)
		{
			$table->dropForeign('haisoujouhou_haisoubango_const');
		});
	}

}
