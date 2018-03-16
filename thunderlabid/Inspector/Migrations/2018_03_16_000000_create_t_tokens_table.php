<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTTokensTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_tokens', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('enjoyer_id');
			$table->string('token');
			$table->string('sent_to');
			$table->string('scope');
			$table->datetime('expired_at')->nullable();
			$table->datetime('clicked_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'scope', 'token']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('t_tokens');
	}
}
