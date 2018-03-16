<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTClampsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_clamps', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('group_id');
			$table->integer('machine_id');
			$table->string('key');
			$table->string('secret');
			$table->boolean('is_allowed')->default(1);
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
		Schema::dropIfExists('t_clamps');
	}
}
