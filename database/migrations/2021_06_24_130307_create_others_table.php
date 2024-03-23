<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOthersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('others', function(Blueprint $table)
		{
			$table->string('other1', 50)->nullable();
			$table->string('other2', 50)->nullable();
			$table->string('other3', 50)->nullable();
			$table->string('other4', 50)->nullable();
			$table->string('other5', 50)->nullable();
			$table->string('other6', 50)->nullable();
			$table->string('other7', 50)->nullable();
			$table->string('other8', 50)->nullable();
			$table->string('other9', 50)->nullable();
			$table->string('other10', 50)->nullable();
			$table->string('other11', 100)->nullable();
			$table->string('other12', 100)->nullable();
			$table->string('other13', 100)->nullable();
			$table->string('other14', 100)->nullable();
			$table->string('other15', 100)->nullable();
			$table->string('other16', 1000)->nullable();
			$table->string('other17', 1000)->nullable();
			$table->string('other18', 1000)->nullable();
			$table->string('other19', 100)->nullable();
			$table->string('other20', 100)->nullable();
			$table->string('other21', 200)->nullable();
			$table->string('other22', 200)->nullable();
			$table->string('other23', 200)->nullable();
			$table->string('other24', 200)->nullable();
			$table->string('other25', 200)->nullable();
			$table->string('other26', 200)->nullable();
			$table->string('other27', 200)->nullable();
			$table->string('other28', 200)->nullable();
			$table->string('other29', 200)->nullable();
			$table->string('other30', 200)->nullable();
			$table->integer('otherint1')->nullable()->index();
			$table->integer('otherint2')->nullable();
			$table->string('other31', 20)->nullable();
			$table->string('other32', 20)->nullable();
			$table->string('other33', 20)->nullable();
			$table->string('other34', 20)->nullable();
			$table->string('other35', 20)->nullable();
			$table->string('other36', 20)->nullable();
			$table->string('other37', 20)->nullable();
			$table->string('other38', 20)->nullable();
			$table->string('other39', 20)->nullable();
			$table->string('other40', 20)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('others');
	}

}
