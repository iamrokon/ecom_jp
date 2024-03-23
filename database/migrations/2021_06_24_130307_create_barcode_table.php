<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarcodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('barcode', function(Blueprint $table)
		{
			$table->integer('kokyakubango')->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->string('codename', 20)->nullable();
			$table->string('code', 50)->nullable();
			$table->integer('barcodesuchi1')->nullable();
			$table->integer('barcodesuchi2')->nullable();
			$table->bigInteger('barcodesuchimax1')->nullable();
			$table->bigInteger('barcodesuchimax2')->nullable();
			$table->string('barcodemoji1', 50)->nullable();
			$table->string('barcodemoji2', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('barcode');
	}

}
