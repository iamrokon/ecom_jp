<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEtsuransyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('etsuransya', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->string('username', 30)->nullable();
			$table->string('userpasswd', 100)->nullable();
			$table->integer('kokyakubango')->nullable();
			$table->string('tantousya', 50)->nullable();
			$table->string('mail1', 100)->nullable();
			$table->string('mail2', 100)->nullable();
			$table->smallInteger('innerlevel')->nullable();
			$table->smallInteger('outerlevel')->nullable();
			$table->string('accescode', 30)->nullable();
			$table->smallInteger('deleteflag')->nullable()->default(0);
			$table->integer('yukokigen')->nullable();
			$table->string('mail3', 100)->nullable();
			$table->string('mail4', 100)->nullable();
			$table->string('mail5', 100)->nullable();
			$table->string('datatxt0014', 50)->nullable();
			$table->string('datatxt0015', 50)->nullable();
			$table->string('datatxt0016', 50)->nullable();
			$table->string('datatxt0017', 1000)->nullable();
			$table->string('datatxt0018', 1000)->nullable();
			$table->string('datatxt0040', 50)->nullable();
			$table->string('datatxt0041', 50)->nullable();
			$table->string('datatxt0042', 50)->nullable();
			$table->string('datatxt0043', 50)->nullable();
			$table->string('datatxt0044', 50)->nullable();
			$table->string('datatxt0045', 50)->nullable();
			$table->string('datatxt0046', 50)->nullable();
			$table->string('datatxt0047', 50)->nullable();
			$table->string('datatxt0048', 50)->nullable();
			$table->string('datatxt0049', 50)->nullable();
			$table->string('datatxt0090', 100)->nullable();
			$table->string('datatxt0091', 100)->nullable();
			$table->string('datatxt0092', 100)->nullable();
			$table->string('datatxt0093', 100)->nullable();
			$table->string('datatxt0094', 100)->nullable();
			$table->string('datatxt0095', 100)->nullable();
			$table->float('datanum0018', 10, 0)->nullable();
			$table->float('datanum0019', 10, 0)->nullable();
			$table->float('datanum0020', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('etsuransya');
	}

}
