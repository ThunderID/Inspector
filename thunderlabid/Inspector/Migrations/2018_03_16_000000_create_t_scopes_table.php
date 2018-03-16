<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTScopesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_scopes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('enjoyer_id');
			$table->string('group_id');
			$table->text('scopes');
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'enjoyer_id', 'group_id']);
            $table->index(['deleted_at', 'group_id', 'enjoyer_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('t_scopes');
	}
}
