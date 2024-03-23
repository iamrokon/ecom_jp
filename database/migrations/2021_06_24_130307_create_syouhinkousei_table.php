<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhinkouseiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhinkousei', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->integer('kouseihin')->nullable();
			$table->float('syoyousu', 10, 0)->nullable();
			$table->string('sagyousyurui', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhinkousei');
	}

}
