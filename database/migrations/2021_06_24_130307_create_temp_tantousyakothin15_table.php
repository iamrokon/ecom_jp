<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempTantousyakothin15Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('temp_tantousyakothin15', function(Blueprint $table)
		{
			$table->string('bango', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->string('htanka', 191)->nullable();
			$table->string('ztanka', 191)->nullable();
			$table->string('datatxt0003', 191)->nullable();
			$table->string('datatxt0004', 191)->nullable();
			$table->string('datatxt0005', 191)->nullable();
			$table->string('syozoku', 191)->nullable();
			$table->string('passwd', 191)->nullable();
			$table->string('mail4', 191)->nullable();
			$table->string('mail2', 191)->nullable();
			$table->string('mail3', 191)->nullable();
			$table->string('mail', 191)->nullable();
			$table->string('datatxt0030', 191)->nullable();
			$table->string('datatxt0031', 191)->nullable();
			$table->string('datatxt0032', 191)->nullable();
			$table->string('datatxt0033', 191)->nullable();
			$table->string('datatxt0034', 191)->nullable();
			$table->string('datatxt0035', 191)->nullable();
			$table->string('datatxt0036', 191)->nullable();
			$table->string('datatxt0037', 191)->nullable();
			$table->string('datatxt0029', 191)->nullable();
			$table->string('deleteflag', 191)->nullable();
			$table->string('datatxt0038', 191)->nullable();
			$table->string('datatxt0039', 191)->nullable();
			$table->string('syounin', 191)->nullable();
			$table->string('mail5', 191)->nullable();
			$table->string('company_1', 191)->nullable();
			$table->string('company_2', 191)->nullable();
			$table->string('company_3', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('temp_tantousyakothin15');
	}

}
