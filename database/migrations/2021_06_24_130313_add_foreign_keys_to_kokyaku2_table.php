<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKokyaku2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kokyaku2', function(Blueprint $table)
		{
			$table->foreign('bango', 'kokyaku2_bango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('bank_cd', 'kokyaku2_bank_cd_const')->references('bank_cd')->on('bank')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('shiharaihouhou', 'kokyaku2_shiharaihouhou_const')->references('bango')->on('shiharaihouhou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kokyaku2', function(Blueprint $table)
		{
			$table->dropForeign('kokyaku2_bango_const');
			$table->dropForeign('kokyaku2_bank_cd_const');
			$table->dropForeign('kokyaku2_shiharaihouhou_const');
		});
	}

}
