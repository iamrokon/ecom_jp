<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyouhin1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syouhin1', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->integer('kokyakubango')->nullable();
			$table->string('name', 100)->nullable();
			$table->string('kokyakusyouhinbango', 100)->nullable()->index();
			$table->string('jouhou')->nullable();
			$table->string('bumon', 50)->nullable();
			$table->string('meker', 50)->nullable();
			$table->string('season', 50)->nullable();
			$table->string('size', 100)->nullable();
			$table->string('kongouritsu', 100)->nullable();
			$table->string('koyuujouhou', 100)->nullable();
			$table->smallInteger('isphoto')->nullable()->default(0);
			$table->smallInteger('iskakaku')->nullable()->default(0);
			$table->smallInteger('isuriage')->nullable()->default(0);
			$table->smallInteger('issyouhin2')->nullable()->default(0);
			$table->string('tokuchou', 100)->nullable();
			$table->string('color', 100)->nullable();
			$table->float('kakaku', 10, 0)->nullable();
			$table->smallInteger('yoyaku')->nullable()->default(0);
			$table->integer('synchrosyouhinbango')->nullable();
			$table->integer('endtime')->nullable();
			$table->string('url', 300)->nullable();
			$table->string('mdjouhou', 200)->nullable();
			$table->string('url_mobile', 300)->nullable();
			$table->smallInteger('isdaihyou')->nullable()->default(0);
			$table->string('data20', 20)->nullable();
			$table->string('data21', 20)->nullable();
			$table->string('data22', 20)->nullable();
			$table->string('data23', 20)->nullable();
			$table->string('data24', 20)->nullable();
			$table->string('data50', 50)->nullable();
			$table->string('data51', 50)->nullable();
			$table->string('data52', 50)->nullable();
			$table->string('data100', 100)->nullable();
			$table->string('data101', 100)->nullable();
			$table->string('code1', 20)->nullable();
			$table->string('code2', 20)->nullable();
			$table->string('code3', 20)->nullable();
			$table->string('name2')->nullable();
			$table->string('data25', 20)->nullable();
			$table->string('data26', 20)->nullable();
			$table->string('data27', 20)->nullable();
			$table->string('data28', 20)->nullable();
			$table->string('data29', 20)->nullable();
			$table->string('data53', 50)->nullable();
			$table->string('data54', 50)->nullable();
			$table->string('data102', 100)->nullable();
			$table->string('data103', 100)->nullable();
			$table->string('data104', 100)->nullable();
			$table->string('datatxt0106', 5000)->nullable();
			$table->string('datatxt0107', 5000)->nullable();
			$table->string('datatxt0108', 5000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syouhin1');
	}

}
