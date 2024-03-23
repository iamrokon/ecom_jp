<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mail', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->string('subject', 100)->nullable();
			$table->string('message', 300)->nullable();
			$table->string('send', 10)->nullable();
			$table->integer('syukei1')->nullable();
			$table->integer('syukei2')->nullable();
			$table->integer('syukei3')->nullable();
			$table->integer('syukei4')->nullable();
			$table->integer('syukei5')->nullable();
			$table->string('text1', 1000)->nullable();
			$table->string('text2', 1000)->nullable();
			$table->string('text3', 1000)->nullable();
			$table->string('text4', 1000)->nullable();
			$table->string('text5', 1000)->nullable();
			$table->string('text6', 1000)->nullable();
			$table->string('text7', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mail');
	}

}
