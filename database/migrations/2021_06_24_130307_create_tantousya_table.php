<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTantousyaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tantousya', function(Blueprint $table)
		{
			$table->string('bango', 20)->primary('tantousya_pkey');
			$table->string('passwd', 100)->nullable();
			$table->string('name', 50)->nullable();
			$table->string('mail', 100)->nullable();
			$table->integer('htanka')->nullable();
			$table->integer('ztanka')->nullable();
			$table->integer('ktanka')->nullable();
			$table->integer('yobi1')->nullable();
			$table->integer('yobi2')->nullable();
			$table->integer('yobi3')->nullable();
			$table->smallInteger('innerlevel')->nullable();
			$table->smallInteger('outerlevel')->nullable();
			$table->string('accesscode', 30)->nullable();
			$table->smallInteger('deleteflag')->nullable()->default(0);
			$table->string('mail2', 100)->nullable();
			$table->string('mail3', 100)->nullable();
			$table->string('mail4', 100)->nullable();
			$table->string('mail5', 100)->nullable();
			$table->string('syozoku', 100)->nullable();
			$table->string('syounin', 100)->nullable();
			$table->string('datatxt0003', 50)->nullable();
			$table->string('datatxt0004', 50)->nullable();
			$table->string('datatxt0005', 50)->nullable();
			$table->string('datatxt0029', 10000)->nullable();
			$table->string('datatxt0030', 100)->nullable();
			$table->string('datatxt0031', 100)->nullable();
			$table->string('datatxt0032', 100)->nullable();
			$table->string('datatxt0033', 100)->nullable();
			$table->string('datatxt0034', 100)->nullable();
			$table->string('datatxt0035', 100)->nullable();
			$table->string('datatxt0036', 100)->nullable();
			$table->string('datatxt0037', 100)->nullable();
			$table->string('datatxt0038', 100)->nullable();
			$table->string('datatxt0039', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tantousya');
	}

}
