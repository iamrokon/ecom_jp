<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSyouhinkouseiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('syouhinkousei', function(Blueprint $table)
		{
			$table->foreign('bango', 'syouhinkousei_bango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kouseihin', 'syouhinkousei_kouseihin_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('syouhinkousei', function(Blueprint $table)
		{
			$table->dropForeign('syouhinkousei_bango_const');
			$table->dropForeign('syouhinkousei_kouseihin_const');
		});
	}

}
