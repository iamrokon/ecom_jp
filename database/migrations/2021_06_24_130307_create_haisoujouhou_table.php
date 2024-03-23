<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHaisoujouhouTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('haisoujouhou', function(Blueprint $table)
		{
			$table->integer('haisoubango')->nullable();
			$table->string('kaiinbango', 50)->nullable();
			$table->string('zokugara', 50)->nullable();
			$table->string('name', 100)->nullable();
			$table->string('yubinbango', 10)->nullable();
			$table->string('address', 200)->nullable();
			$table->string('tel', 15)->nullable();
			$table->string('mail', 100)->nullable();
			$table->dateTime('birthday')->nullable();
			$table->string('sex', 10)->nullable();
			$table->integer('point')->nullable();
			$table->string('bunrui1', 50)->nullable();
			$table->string('bunrui2', 50)->nullable();
			$table->string('bunrui3', 50)->nullable();
			$table->string('bunrui4', 50)->nullable();
			$table->string('bunrui5', 50)->nullable();
			$table->float('syukei1', 10, 0)->nullable();
			$table->float('syukei2', 10, 0)->nullable();
			$table->float('syukei3', 10, 0)->nullable();
			$table->float('syukei4', 10, 0)->nullable();
			$table->float('syukei5', 10, 0)->nullable();
			$table->string('netusername', 100)->nullable();
			$table->string('netuserpasswd', 50)->nullable();
			$table->string('netlogin', 20)->nullable();
			$table->float('kounyusu', 10, 0)->nullable();
			$table->float('kingakugoukei', 10, 0)->nullable();
			$table->string('syukeitukikijun', 10)->nullable();
			$table->string('syukeituki', 150)->nullable();
			$table->string('syukeikikijun', 10)->nullable();
			$table->string('syukeiki', 20)->nullable();
			$table->string('syukeinenkijun', 10)->nullable();
			$table->string('syukeinen', 10)->nullable();
			$table->integer('starttime')->nullable();
			$table->integer('endtime')->nullable();
			$table->string('bunrui6', 200)->nullable();
			$table->string('bunrui7', 200)->nullable();
			$table->string('bunrui8', 200)->nullable();
			$table->string('bunrui9', 200)->nullable();
			$table->string('bunrui10', 200)->nullable();
			$table->float('syukei6', 10, 0)->nullable();
			$table->float('syukei7', 10, 0)->nullable();
			$table->float('syukei8', 10, 0)->nullable();
			$table->float('syukei9', 10, 0)->nullable();
			$table->float('syukei10', 10, 0)->nullable();
			$table->string('datatxt0050', 100)->nullable();
			$table->string('datatxt0051', 100)->nullable();
			$table->string('datatxt0052', 100)->nullable();
			$table->string('datatxt0053', 100)->nullable();
			$table->string('datatxt0054', 100)->nullable();
			$table->string('datatxt0055', 100)->nullable();
			$table->string('datatxt0056', 100)->nullable();
			$table->string('datatxt0057', 100)->nullable();
			$table->string('datatxt0058', 100)->nullable();
			$table->string('datatxt0059', 100)->nullable();
			$table->string('datatxt0060', 100)->nullable();
			$table->string('datatxt0061', 100)->nullable();
			$table->string('datatxt0062', 100)->nullable();
			$table->string('datatxt0063', 100)->nullable();
			$table->string('datatxt0064', 100)->nullable();
			$table->string('datatxt0065', 100)->nullable();
			$table->string('datatxt0066', 100)->nullable();
			$table->string('datatxt0067', 100)->nullable();
			$table->string('datatxt0068', 100)->nullable();
			$table->string('datatxt0069', 100)->nullable();
			$table->string('datatxt0070', 100)->nullable();
			$table->string('datatxt0071', 100)->nullable();
			$table->string('datatxt0072', 100)->nullable();
			$table->string('datatxt0073', 100)->nullable();
			$table->string('datatxt0074', 100)->nullable();
			$table->string('datatxt0075', 100)->nullable();
			$table->string('datatxt0076', 100)->nullable();
			$table->string('datatxt0077', 100)->nullable();
			$table->string('datatxt0078', 100)->nullable();
			$table->string('datatxt0079', 100)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('haisoujouhou');
	}

}
