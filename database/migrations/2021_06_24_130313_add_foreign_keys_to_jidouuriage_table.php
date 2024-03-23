<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToJidouuriageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('jidouuriage', function(Blueprint $table)
		{
			$table->foreign('haisoubango', 'jidouuriage_haisoubango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kakakutaibango', 'jidouuriage_kakautaibango_const')->references('bango')->on('kakakutai')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('kokyakubango', 'jidouuriage_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('soukobango', 'jidouuriage_soukobango_const')->references('bango')->on('souko')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'jidouuriage_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('jidouuriage', function(Blueprint $table)
		{
			$table->dropForeign('jidouuriage_haisoubango_const');
			$table->dropForeign('jidouuriage_kakautaibango_const');
			$table->dropForeign('jidouuriage_kokyakubango_const');
			$table->dropForeign('jidouuriage_soukobango_const');
			$table->dropForeign('jidouuriage_syouhinbango_const');
		});
	}

}
