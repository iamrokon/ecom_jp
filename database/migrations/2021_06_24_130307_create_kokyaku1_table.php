<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKokyaku1Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kokyaku1', function(Blueprint $table)
		{
			$table->integer('bango', true);
			$table->string('name', 200)->nullable();
			$table->string('yubinbango', 10)->nullable();
			$table->string('address', 200)->nullable();
			$table->string('tel', 15)->nullable();
			$table->string('fax', 15)->nullable();
			$table->smallInteger('hantei')->nullable()->default(0);
			$table->dateTime('juchujigen')->nullable();
			$table->string('furigana', 400)->nullable();
			$table->string('torihikisakibango', 20)->nullable();
			$table->string('tantousya', 50)->nullable();
			$table->float('kakeritu', 10, 0)->nullable();
			$table->integer('yobi11')->nullable();
			$table->string('yobi12', 20)->nullable();
			$table->integer('denpyostart')->nullable();
			$table->integer('denpyoend')->nullable();
			$table->integer('denpyosaiban')->nullable();
			$table->smallInteger('denpyosyurui')->nullable();
			$table->integer('genkaikingaku')->nullable();
			$table->integer('daibiki')->nullable();
			$table->integer('souryou')->nullable();
			$table->string('kcode1', 20)->nullable();
			$table->string('kcode2', 20)->nullable();
			$table->string('kcode3', 20)->nullable();
			$table->smallInteger('point1')->nullable();
			$table->smallInteger('point2')->nullable();
			$table->smallInteger('point3')->nullable();
			$table->string('yobi13', 100)->nullable();
			$table->integer('soukobango')->nullable();
			$table->integer('souryougenkai')->nullable();
			$table->integer('daibikigenkai')->nullable();
			$table->integer('kakakutaibango1')->nullable();
			$table->integer('kakakutaibango2')->nullable();
			$table->smallInteger('black1')->nullable();
			$table->smallInteger('black2')->nullable();
			$table->string('ytoiawsestart', 20)->nullable();
			$table->string('ytoiawseend', 20)->nullable();
			$table->string('ytoiawsesaiban', 20)->nullable();
			$table->string('yetoiawsestart', 20)->nullable();
			$table->string('yetoiawseend', 20)->nullable();
			$table->string('yetoiawsesaiban', 20)->nullable();
			$table->string('mail_soushin', 100)->nullable();
			$table->string('mail_jyushin', 100)->nullable();
			$table->string('mail_nouhin', 100)->nullable();
			$table->string('mail_toiawase', 100)->nullable();
			$table->string('mallsoukobango1', 50)->nullable();
			$table->string('mallsoukobango2', 50)->nullable();
			$table->string('mallsoukobango3', 50)->nullable();
			$table->integer('pointlimit')->nullable();
			$table->string('pointterm', 10)->nullable();
			$table->smallInteger('ec_jyougensu')->nullable();
			$table->smallInteger('ec_kinsyousu')->nullable();
			$table->string('mail_soushin_mb', 100)->nullable();
			$table->string('mail_jyushin_mb', 100)->nullable();
			$table->string('mail_nouhin_mb', 100)->nullable();
			$table->string('mail_toiawase_mb', 100)->nullable();
			$table->smallInteger('review_flag')->nullable();
			$table->smallInteger('review_check_flag')->nullable();
			$table->string('kcode4', 20)->nullable();
			$table->string('kcode5', 20)->nullable();
			$table->integer('pointwait')->nullable();
			$table->string('domain', 300)->nullable();
			$table->string('domain2', 300)->nullable();
			$table->string('stoiawsestart', 20)->nullable();
			$table->string('stoiawseend', 20)->nullable();
			$table->string('stoiawsesaiban', 20)->nullable();
			$table->string('yokurijyouhinmei', 50)->nullable();
			$table->string('yekessaihouhou', 50)->nullable();
			$table->string('sokurijyouhinmei', 50)->nullable();
			$table->string('sekessaihouhou', 50)->nullable();
			$table->string('kensakukey', 1000)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kokyaku1');
	}

}
