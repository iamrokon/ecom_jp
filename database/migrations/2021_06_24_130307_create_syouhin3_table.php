<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhin3Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhin3', function(Blueprint $table)
		{
			$table->integer('bango')->primary('syouhin3_pkey');
			$table->integer('lots')->nullable();
			$table->smallInteger('leadtime')->nullable();
			$table->smallInteger('syoumikigen')->nullable();
			$table->float('tekiseizaiko', 10, 0)->nullable();
			$table->float('kikenritsu', 10, 0)->nullable();
			$table->float('keisangenka', 10, 0)->nullable();
			$table->string('yobi2', 20)->nullable();
			$table->integer('syouhizeikubunshire')->nullable();
			$table->integer('syouhizeikubunhanbai')->nullable();
			$table->float('syouhizeiritu', 10, 0)->nullable();
			$table->smallInteger('syoumikigen2')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhin3');
	}

}
