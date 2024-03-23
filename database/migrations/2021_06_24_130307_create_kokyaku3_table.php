<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKokyaku3Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kokyaku3', function(Blueprint $table)
		{
			$table->integer('bango')->primary('kokyaku3_pkey');
			$table->smallInteger('nenreisou')->nullable();
			$table->smallInteger('seibetsu')->nullable()->default(0);
			$table->float('syouhizeikeisanhouhou', 10, 0)->nullable();
			$table->float('syouhizeiritu', 10, 0)->nullable();
			$table->smallInteger('seikyuhantei')->nullable();
			$table->string('yobi1', 10)->nullable();
			$table->integer('syouhizeikubunshire')->nullable();
			$table->integer('syouhizeikubunhanbai')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kokyaku3');
	}

}
