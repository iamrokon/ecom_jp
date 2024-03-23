<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMailsendTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mailsend', function(Blueprint $table)
		{
			$table->foreign('etsuransyabango', 'mailsend_etsuransyabango_const')->references('bango')->on('etsuransya')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('mailbango', 'mailsend_mailbango_const')->references('bango')->on('mail')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('syukkosakibango', 'mailsend_syukkosakibango_const')->references('bango')->on('haisou')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mailsend', function(Blueprint $table)
		{
			$table->dropForeign('mailsend_etsuransyabango_const');
			$table->dropForeign('mailsend_mailbango_const');
			$table->dropForeign('mailsend_syukkosakibango_const');
		});
	}

}
