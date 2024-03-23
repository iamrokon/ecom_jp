<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategorykanriTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categorykanri', function(Blueprint $table)
		{
			$table->integer('bango')->nullable();
			$table->string('zokusei', 100)->nullable();
			$table->string('category1', 50)->nullable();
			$table->string('category2', 50)->nullable();
			$table->string('groupbango', 20)->nullable();
			$table->integer('osusume')->nullable();
			$table->bigInteger('suchi1')->nullable();
			$table->bigInteger('suchi2')->nullable();
			$table->string('image1', 300)->nullable();
			$table->string('image2', 300)->nullable();
			$table->string('image3', 300)->nullable();
			$table->string('patternsub1', 200)->nullable();
			$table->string('patternsub2', 200)->nullable();
			$table->string('text', 1000)->nullable();
			$table->integer('kokyakubango')->nullable();
			$table->string('category3', 50)->nullable();
			$table->string('category4', 50)->nullable();
			$table->string('category5', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categorykanri');
	}

}
