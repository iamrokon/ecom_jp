<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToKakakutaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('kakakutai', function(Blueprint $table)
		{
			$table->foreign('innerlevel', 'kakakutai_innerlevel_const')->references('level')->on('innerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kokyakubango', 'kakakutai_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('outerlevel', 'kakakutai_outerlevel_const')->references('level')->on('outerrank')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('kakakutai', function(Blueprint $table)
		{
			$table->dropForeign('kakakutai_innerlevel_const');
			$table->dropForeign('kakakutai_kokyakubango_const');
			$table->dropForeign('kakakutai_outerlevel_const');
		});
	}

}
