<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBankshitenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bankshiten', function(Blueprint $table)
		{
			$table->foreign('bank_cd', 'bankshiten_bank_cd_const')->references('bank_cd')->on('bank')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bankshiten', function(Blueprint $table)
		{
			$table->dropForeign('bankshiten_bank_cd_const');
		});
	}

}
