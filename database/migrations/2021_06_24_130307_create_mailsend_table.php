<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailsendTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mailsend', function(Blueprint $table)
		{
			$table->integer('mailbango')->nullable();
			$table->integer('etsuransyabango')->nullable();
			$table->integer('syukkosakibango')->nullable();
			$table->string('datatxt0006', 100)->nullable();
			$table->string('datatxt0007', 100)->nullable();
			$table->string('datatxt0008', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mailsend');
	}

}
