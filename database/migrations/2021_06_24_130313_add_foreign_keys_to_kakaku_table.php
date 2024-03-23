<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKakakuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kakaku', function(Blueprint $table)
		{
			$table->foreign('kakakutaibango', 'kakaku_kakakutaibango_const')->references('bango')->on('kakakutai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'kakaku_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kakaku', function(Blueprint $table)
		{
			$table->dropForeign('kakaku_kakakutaibango_const');
			$table->dropForeign('kakaku_syouhinbango_const');
		});
	}

}
