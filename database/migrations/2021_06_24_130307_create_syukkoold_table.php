<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSyukkooldTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('syukkoold', function(Blueprint $table)
		{
			$table->integer('orderbango')->nullable();
			$table->integer('syouhinbango')->nullable();
			$table->float('yoteisu', 10, 0)->nullable();
			$table->dateTime('yoteibi')->nullable();
			$table->float('syukkasu', 10, 0)->nullable();
			$table->dateTime('kanryoubi')->nullable();
			$table->float('kingaku', 10, 0)->nullable();
			$table->float('genka', 10, 0)->nullable();
			$table->float('syouhizeiritu', 10, 0)->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('syukkomotobango')->nullable();
			$table->integer('syukkosakibango')->nullable();
			$table->integer('syukkosoukobango')->nullable();
			$table->string('tanabango', 250)->nullable();
			$table->string('tantousyabango', 20)->nullable();
			$table->integer('seikyubango')->nullable();
			$table->integer('denpyobango')->nullable();
			$table->dateTime('denpyohakkoubi')->nullable();
			$table->integer('season')->nullable();
			$table->integer('nengetsu')->nullable();
			$table->integer('weeks')->nullable();
			$table->integer('day')->nullable();
			$table->float('tanka', 10, 0)->nullable();
			$table->float('zaiko', 10, 0)->nullable();
			$table->string('idoutanabango', 20)->nullable();
			$table->integer('yoteimeter')->nullable();
			$table->integer('syukkameter')->nullable();
			$table->float('zaikometer', 10, 0)->nullable();
			$table->string('barcode', 100)->nullable();
			$table->string('codename', 20)->nullable();
			$table->dateTime('denpyoshimebi')->nullable();
			$table->float('kawaserate', 10, 0)->nullable();
			$table->string('kawasename', 10)->nullable();
			$table->integer('syouhizeikubun')->nullable();
			$table->dateTime('yoyakubi')->nullable();
			$table->string('syouhinname')->nullable();
			$table->string('kaiinid', 20)->nullable()->index();
			$table->string('syouhinid', 100)->nullable();
			$table->smallInteger('syouhinsyu')->nullable();
			$table->smallInteger('hantei')->nullable();
			$table->float('dataint01', 10, 0)->nullable();
			$table->float('dataint02', 10, 0)->nullable();
			$table->float('dataint03', 10, 0)->nullable();
			$table->string('datachar01', 50)->nullable();
			$table->string('datachar02', 50)->nullable();
			$table->string('datachar03', 50)->nullable();
			$table->string('recordnumber', 50)->nullable();
			$table->float('dataint04', 10, 0)->nullable();
			$table->float('dataint05', 10, 0)->nullable();
			$table->string('datachar04', 10000)->nullable();
			$table->string('datachar05', 10000)->nullable();
			$table->float('dataint06', 10, 0)->nullable();
			$table->float('dataint07', 10, 0)->nullable();
			$table->float('dataint08', 10, 0)->nullable();
			$table->float('dataint09', 10, 0)->nullable();
			$table->float('dataint10', 10, 0)->nullable();
			$table->string('datachar06', 10000)->nullable();
			$table->string('datachar07', 10000)->nullable();
			$table->string('datachar08', 10000)->nullable();
			$table->string('datachar09', 10000)->nullable();
			$table->string('datachar10', 10000)->nullable();
			$table->string('tankano', 20)->nullable();
			$table->string('syouhinbukacd', 20)->nullable();
			$table->string('hanbaibukacd', 20)->nullable();
			$table->float('dataint11', 10, 0)->nullable();
			$table->float('dataint12', 10, 0)->nullable();
			$table->float('dataint13', 10, 0)->nullable();
			$table->float('dataint14', 10, 0)->nullable();
			$table->float('dataint15', 10, 0)->nullable();
			$table->string('datachar11', 10000)->nullable();
			$table->string('datachar12', 10000)->nullable();
			$table->string('datachar13', 10000)->nullable();
			$table->string('datachar14', 10000)->nullable();
			$table->string('datachar15', 10000)->nullable();
			$table->float('dataint16', 10, 0)->nullable();
			$table->float('dataint17', 10, 0)->nullable();
			$table->float('dataint18', 10, 0)->nullable();
			$table->float('dataint19', 10, 0)->nullable();
			$table->float('dataint20', 10, 0)->nullable();
			$table->string('datachar16', 10000)->nullable();
			$table->string('datachar17', 10000)->nullable();
			$table->string('datachar18', 10000)->nullable();
			$table->string('datachar19', 10000)->nullable();
			$table->string('datachar20', 10000)->nullable();
			$table->float('dataint21', 10, 0)->nullable();
			$table->float('dataint22', 10, 0)->nullable();
			$table->float('dataint23', 10, 0)->nullable();
			$table->float('dataint24', 10, 0)->nullable();
			$table->float('dataint25', 10, 0)->nullable();
			$table->float('dataint26', 10, 0)->nullable();
			$table->float('dataint27', 10, 0)->nullable();
			$table->float('dataint28', 10, 0)->nullable();
			$table->float('dataint29', 10, 0)->nullable();
			$table->float('dataint30', 10, 0)->nullable();
			$table->string('datachar21', 10000)->nullable();
			$table->string('datachar22', 10000)->nullable();
			$table->string('datachar23', 10000)->nullable();
			$table->string('datachar24', 10000)->nullable();
			$table->string('datachar25', 10000)->nullable();
			$table->string('datachar26', 10000)->nullable();
			$table->string('datachar27', 10000)->nullable();
			$table->string('datachar28', 10000)->nullable();
			$table->string('datachar29', 10000)->nullable();
			$table->string('datachar30', 10000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('syukkoold');
	}

}
