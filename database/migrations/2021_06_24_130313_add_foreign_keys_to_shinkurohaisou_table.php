<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShinkurohaisouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shinkurohaisou', function(Blueprint $table)
		{
			$table->foreign('bango', 'shinkurohaisou_bango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('soukobango', 'shinkurohaisou_soukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shinkurohaisou', function(Blueprint $table)
		{
			$table->dropForeign('shinkurohaisou_bango_const');
			$table->dropForeign('shinkurohaisou_soukobango_const');
		});
	}

}
