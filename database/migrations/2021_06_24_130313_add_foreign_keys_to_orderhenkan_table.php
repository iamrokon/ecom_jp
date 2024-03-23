<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOrderhenkanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orderhenkan', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'orderhenkan_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ordertypebango', 'orderhenkan_ordertypebango_const')->references('bango')->on('ordertype')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orderhenkan', function(Blueprint $table)
		{
			$table->dropForeign('orderhenkan_kokyakubango_const');
			$table->dropForeign('orderhenkan_ordertypebango_const');
		});
	}

}
