<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhin2Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhin2', function(Blueprint $table)
		{
			$table->integer('bango')->primary('syouhin2_pkey');
			$table->string('jouhou2', 100)->nullable();
			$table->float('irisu', 10, 0)->nullable();
			$table->string('konpoumei', 20)->nullable();
			$table->smallInteger('iskouseihin')->nullable()->default(0);
			$table->float('genka', 10, 0)->nullable();
			$table->string('catalogbango', 20)->nullable();
			$table->smallInteger('issyouhin3')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhin2');
	}

}
