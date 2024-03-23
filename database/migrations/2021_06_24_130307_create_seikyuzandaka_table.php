<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeikyuzandakaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seikyuzandaka', function(Blueprint $table)
		{
			$table->dateTime('date0009')->nullable();
			$table->string('datatxt0142', 100)->nullable();
			$table->integer('datanum0051')->nullable();
			$table->integer('datanum0052')->nullable();
			$table->integer('datanum0053')->nullable();
			$table->integer('datanum0054')->nullable();
			$table->integer('datanum0055')->nullable();
			$table->integer('datanum0056')->nullable();
			$table->integer('datanum0057')->nullable();
			$table->integer('datanum0058')->nullable();
			$table->integer('datanum0059')->nullable();
			$table->integer('datanum0060')->nullable();
			$table->integer('datanum0061')->nullable();
			$table->integer('datanum0062')->nullable();
			$table->integer('datanum0063')->nullable();
			$table->integer('datanum0064')->nullable();
			$table->integer('datanum0065')->nullable();
			$table->integer('datanum0066')->nullable();
			$table->integer('datanum0067')->nullable();
			$table->integer('datanum0068')->nullable();
			$table->integer('datanum0069')->nullable();
			$table->integer('datanum0070')->nullable();
			$table->integer('datanum0071')->nullable();
			$table->integer('datanum0072')->nullable();
			$table->integer('datanum0073')->nullable();
			$table->integer('datanum0074')->nullable();
			$table->integer('datanum0075')->nullable();
			$table->dateTime('date0010')->nullable();
			$table->dateTime('date0011')->nullable();
			$table->string('datatxt0143', 100)->nullable();
			$table->integer('datanum0076')->nullable();
			$table->integer('datanum0077')->nullable();
			$table->integer('datanum0078')->nullable();
			$table->integer('datanum0079')->nullable();
			$table->integer('datanum0080')->nullable();
			$table->integer('datanum0081')->nullable();
			$table->integer('datanum0082')->nullable();
			$table->integer('datanum0083')->nullable();
			$table->integer('datanum0084')->nullable();
			$table->integer('datanum0085')->nullable();
			$table->string('datatxt0144', 100)->nullable();
			$table->string('datatxt0145', 100)->nullable();
			$table->string('datatxt0146', 100)->nullable();
			$table->integer('datanum0086')->nullable();
			$table->integer('datanum0087')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seikyuzandaka');
	}

}
