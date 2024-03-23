<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupskouseiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('groupskousei', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->integer('kouseibango')->nullable()->index();
			$table->string('istype', 100)->nullable();
			$table->smallInteger('number')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groupskousei');
	}

}
