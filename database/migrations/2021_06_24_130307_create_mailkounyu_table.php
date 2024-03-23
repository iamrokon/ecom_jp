<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailkounyuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mailkounyu', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('kokyakubango')->nullable();
			$table->string('mail', 100)->nullable();
			$table->string('syouhinkey', 100)->nullable();
			$table->integer('kakakutaibango')->nullable();
			$table->string('horyuflag', 100)->nullable();
			$table->string('yobichar01', 50)->nullable();
			$table->string('yobichar02', 50)->nullable();
			$table->string('yobichar03', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mailkounyu');
	}

}
