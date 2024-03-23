<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKokyaku2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kokyaku2', function(Blueprint $table)
		{
			$table->integer('bango')->primary('kokyaku2_pkey');
			$table->smallInteger('shimebi')->nullable();
			$table->string('shiharaibi', 10)->nullable();
			$table->integer('shiharaihouhou')->nullable();
			$table->smallInteger('bank_cd')->nullable();
			$table->smallInteger('bank_scd')->nullable();
			$table->smallInteger('yokinsyu')->nullable();
			$table->string('kouza_7keta', 7)->nullable();
			$table->string('meiginin', 30)->nullable();
			$table->smallInteger('syouhizei')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kokyaku2');
	}

}
