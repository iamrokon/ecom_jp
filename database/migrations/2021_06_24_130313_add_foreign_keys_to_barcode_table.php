<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBarcodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('barcode', function(Blueprint $table)
		{
			$table->foreign('kokyakubango', 'barcode_kokyakubango_const')->references('bango')->on('kokyaku1')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syouhinbango', 'barcode_syouhinbango_const')->references('bango')->on('syouhin1')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('barcode', function(Blueprint $table)
		{
			$table->dropForeign('barcode_kokyakubango_const');
			$table->dropForeign('barcode_syouhinbango_const');
		});
	}

}
