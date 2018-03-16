<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTGroupsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_groups', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama');
			$table->string('gif_number');
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
		Schema::dropIfExists('t_groups');
	}
}
