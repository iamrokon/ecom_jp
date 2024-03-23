<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTuhanorderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tuhanorder', function(Blueprint $table)
		{
			$table->integer('orderbango')->primary('tuhanorder_pkey');
			$table->string('juchubango', 50)->nullable();
			$table->string('chumonbango', 50)->nullable();
			$table->string('juchukubun1', 1000)->nullable();
			$table->string('juchukubun2', 50)->nullable();
			$table->dateTime('chumondate')->nullable();
			$table->dateTime('otodokedate')->nullable();
			$table->string('otodoketime', 20)->nullable();
			$table->integer('chumonsyabango')->nullable();
			$table->integer('soufusakibango')->nullable();
			$table->string('kessaihouhou', 50)->nullable();
			$table->string('housoukubun', 20)->nullable();
			$table->string('chumonsyajouhou', 100)->nullable();
			$table->string('soufusakijouhou', 100)->nullable();
			$table->integer('numeric1')->nullable();
			$table->integer('numeric2')->nullable();
			$table->integer('numeric3')->nullable();
			$table->integer('numeric4')->nullable();
			$table->integer('numeric5')->nullable();
			$table->bigInteger('numericmax')->nullable();
			$table->float('money1', 10, 0)->nullable();
			$table->float('money2', 10, 0)->nullable();
			$table->float('money3', 10, 0)->nullable();
			$table->float('money4', 10, 0)->nullable();
			$table->float('money5', 10, 0)->nullable();
			$table->float('moneymax', 10, 0)->nullable();
			$table->string('information1', 50)->nullable();
			$table->string('information2', 50)->nullable();
			$table->string('information3', 50)->nullable();
			$table->string('information4', 50)->nullable();
			$table->string('information5', 1000)->nullable();
			$table->float('nyukingaku', 10, 0)->nullable();
			$table->float('unsoudaibikitesuryou', 10, 0)->nullable();
			$table->integer('unsoutesuryou')->nullable();
			$table->float('unsouinchigaku', 10, 0)->nullable();
			$table->integer('unsousplittesuryou')->nullable();
			$table->string('youbou', 1000)->nullable();
			$table->string('affbango', 20)->nullable();
			$table->float('syukei1', 10, 0)->nullable();
			$table->float('syukei2', 10, 0)->nullable();
			$table->float('syukei3', 10, 0)->nullable();
			$table->float('syukei4', 10, 0)->nullable();
			$table->float('syukei5', 10, 0)->nullable();
			$table->string('text1', 1000)->nullable();
			$table->string('text2', 1000)->nullable();
			$table->string('text3', 1000)->nullable();
			$table->string('text4', 1000)->nullable();
			$table->string('text5', 1000)->nullable();
			$table->integer('numeric6')->nullable();
			$table->integer('numeric7')->nullable();
			$table->integer('numeric8')->nullable();
			$table->integer('numeric9')->nullable();
			$table->integer('numeric10')->nullable();
			$table->float('money6', 10, 0)->nullable();
			$table->float('money7', 10, 0)->nullable();
			$table->float('money8', 10, 0)->nullable();
			$table->float('money9', 10, 0)->nullable();
			$table->float('money10', 10, 0)->nullable();
			$table->string('information6', 1000)->nullable();
			$table->string('information7', 1000)->nullable();
			$table->string('information8', 1000)->nullable();
			$table->string('information9', 1000)->nullable();
			$table->string('information10', 1000)->nullable();
			$table->string('datatxt0109', 100)->nullable();
			$table->string('datatxt0110', 100)->nullable();
			$table->string('datatxt0111', 100)->nullable();
			$table->string('datatxt0112', 100)->nullable();
			$table->string('datatxt0113', 100)->nullable();
			$table->string('datatxt0114', 100)->nullable();
			$table->string('datatxt0115', 100)->nullable();
			$table->string('datatxt0116', 100)->nullable();
			$table->string('datatxt0117', 100)->nullable();
			$table->string('datatxt0118', 100)->nullable();
			$table->string('datatxt0119', 100)->nullable();
			$table->string('datatxt0120', 100)->nullable();
			$table->string('datatxt0121', 100)->nullable();
			$table->string('datatxt0122', 100)->nullable();
			$table->string('datatxt0123', 100)->nullable();
			$table->string('datatxt0124', 100)->nullable();
			$table->string('datatxt0125', 100)->nullable();
			$table->string('datatxt0126', 100)->nullable();
			$table->string('datatxt0127', 100)->nullable();
			$table->string('datatxt0128', 1000)->nullable();
			$table->string('datatxt0129', 1000)->nullable();
			$table->string('datatxt0130', 1000)->nullable();
			$table->string('datatxt0131', 1000)->nullable();
			$table->string('datatxt0132', 1000)->nullable();
			$table->string('datatxt0133', 1000)->nullable();
			$table->string('datatxt0134', 1000)->nullable();
			$table->string('datatxt0135', 1000)->nullable();
			$table->string('datatxt0136', 1000)->nullable();
			$table->string('datatxt0137', 1000)->nullable();
			$table->dateTime('date0001')->nullable();
			$table->dateTime('date0002')->nullable();
			$table->dateTime('date0003')->nullable();
			$table->dateTime('date0004')->nullable();
			$table->dateTime('date0005')->nullable();
			$table->dateTime('date0006')->nullable();
			$table->dateTime('date0007')->nullable();
			$table->index(['orderbango','soufusakibango'], 'tuhanorder_orderbango_syukkosakibango_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tuhanorder');
	}

}
