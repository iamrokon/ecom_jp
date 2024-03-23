<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUrikakezandakaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('urikakezandaka', function(Blueprint $table)
		{
			$table->dateTime('date0008')->nullable();
			$table->string('datatxt0138', 100)->nullable();
			$table->integer('datanum0021')->nullable();
			$table->integer('datanum0022')->nullable();
			$table->integer('datanum0023')->nullable();
			$table->integer('datanum0024')->nullable();
			$table->integer('datanum0025')->nullable();
			$table->integer('datanum0026')->nullable();
			$table->integer('datanum0027')->nullable();
			$table->integer('datanum0028')->nullable();
			$table->integer('datanum0029')->nullable();
			$table->integer('datanum0030')->nullable();
			$table->integer('datanum0031')->nullable();
			$table->integer('datanum0032')->nullable();
			$table->integer('datanum0033')->nullable();
			$table->integer('datanum0034')->nullable();
			$table->integer('datanum0035')->nullable();
			$table->integer('datanum0036')->nullable();
			$table->integer('datanum0037')->nullable();
			$table->integer('datanum0038')->nullable();
			$table->integer('datanum0039')->nullable();
			$table->integer('datanum0040')->nullable();
			$table->integer('datanum0041')->nullable();
			$table->integer('datanum0042')->nullable();
			$table->integer('datanum0043')->nullable();
			$table->integer('datanum0044')->nullable();
			$table->integer('datanum0045')->nullable();
			$table->integer('datanum0046')->nullable();
			$table->integer('datanum0047')->nullable();
			$table->integer('datanum0048')->nullable();
			$table->integer('datanum0049')->nullable();
			$table->integer('datanum0050')->nullable();
			$table->string('datatxt0139', 100)->nullable();
			$table->string('datatxt0140', 100)->nullable();
			$table->string('datatxt0141', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('urikakezandaka');
	}

}
