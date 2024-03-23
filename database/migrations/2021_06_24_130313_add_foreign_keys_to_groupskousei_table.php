<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroupskouseiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('groupskousei', function(Blueprint $table)
		{
			$table->foreign('bango', 'groupskousei_bango_const')->references('bango')->on('groups')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('groupskousei', function(Blueprint $table)
		{
			$table->dropForeign('groupskousei_bango_const');
		});
	}

}
