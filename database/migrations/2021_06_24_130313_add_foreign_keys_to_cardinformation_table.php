<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCardinformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cardinformation', function(Blueprint $table)
		{
			$table->foreign('haisoubango', 'cardinformation_haisoubango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('orderbango', 'cardinformation_orderbango_const')->references('bango')->on('orderhenkan')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cardinformation', function(Blueprint $table)
		{
			$table->dropForeign('cardinformation_haisoubango_const');
			$table->dropForeign('cardinformation_orderbango_const');
		});
	}

}
