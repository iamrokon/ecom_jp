<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankshitenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bankshiten', function(Blueprint $table)
		{
			$table->smallInteger('bank_cd');
			$table->smallInteger('bank_scd');
			$table->string('ginshiten_nm', 15)->nullable();
			$table->primary(['bank_cd','bank_scd'], 'bankshiten_pkey');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bankshiten');
	}

}
