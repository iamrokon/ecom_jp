<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEtsurankokyakuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('etsurankokyaku', function(Blueprint $table)
		{
			$table->foreign('bango', 'etsurankokyaku_bango_const')->references('bango')->on('etsuransya')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kakakutaibango', 'etsurankokyaku_kakakutaibango_const')->references('bango')->on('kakakutai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kokyakubango', 'etsurankokyaku_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('etsurankokyaku', function(Blueprint $table)
		{
			$table->dropForeign('etsurankokyaku_bango_const');
			$table->dropForeign('etsurankokyaku_kakakutaibango_const');
			$table->dropForeign('etsurankokyaku_kokyakubango_const');
		});
	}

}
