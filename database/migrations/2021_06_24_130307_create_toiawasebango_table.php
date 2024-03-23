<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateToiawasebangoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('toiawasebango', function(Blueprint $table)
		{
			$table->integer('orderbango')->nullable();
			$table->integer('syukkosakibango')->nullable();
			$table->string('unsoumei', 50)->nullable();
			$table->string('toiawasebango', 50)->nullable()->index();
			$table->smallInteger('konpousu')->nullable();
			$table->dateTime('touchakudate')->nullable();
			$table->string('touchakutime', 50)->nullable();
			$table->string('bikou1', 1000)->nullable()->index();
			$table->string('bikou2', 1000)->nullable();
			$table->string('denpyoname', 20)->nullable();
			$table->integer('dataint01')->nullable();
			$table->integer('dataint02')->nullable();
			$table->integer('dataint03')->nullable();
			$table->string('datachar01', 100)->nullable();
			$table->string('datachar02', 100)->nullable();
			$table->string('datachar03', 100)->nullable();
			$table->integer('datanum0001')->nullable();
			$table->integer('datanum0002')->nullable();
			$table->string('datatxt0001', 100)->nullable();
			$table->string('datatxt0002', 100)->nullable();
			$table->float('datanum0008', 10, 0)->nullable();
			$table->float('datanum0009', 10, 0)->nullable();
			$table->float('datanum0010', 10, 0)->nullable();
			$table->float('datanum0011', 10, 0)->nullable();
			$table->float('datanum0012', 10, 0)->nullable();
			$table->float('datanum0013', 10, 0)->nullable();
			$table->float('datanum0014', 10, 0)->nullable();
			$table->float('datanum0015', 10, 0)->nullable();
			$table->float('datanum0016', 10, 0)->nullable();
			$table->float('datanum0017', 10, 0)->nullable();
			$table->string('datatxt0019', 1000)->nullable();
			$table->string('datatxt0020', 1000)->nullable();
			$table->string('datatxt0021', 1000)->nullable();
			$table->string('datatxt0022', 1000)->nullable();
			$table->string('datatxt0023', 1000)->nullable();
			$table->string('datatxt0024', 1000)->nullable();
			$table->string('datatxt0025', 1000)->nullable();
			$table->string('datatxt0026', 1000)->nullable();
			$table->string('datatxt0027', 1000)->nullable();
			$table->string('datatxt0028', 1000)->nullable();
			$table->index(['orderbango','syukkosakibango']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('toiawasebango');
	}

}
