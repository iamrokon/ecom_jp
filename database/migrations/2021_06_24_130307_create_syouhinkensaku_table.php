<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhinkensakuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhinkensaku', function(Blueprint $table)
		{
			$table->integer('bango')->primary('syouhinkensaku_pkey');
			$table->string('keywords', 100)->nullable();
			$table->string('text1', 5000)->nullable();
			$table->string('text2', 5000)->nullable();
			$table->integer('numdata1')->nullable();
			$table->integer('numdata2')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhinkensaku');
	}

}
