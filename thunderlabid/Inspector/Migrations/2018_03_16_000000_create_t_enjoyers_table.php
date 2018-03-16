<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEnjoyersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_enjoyers', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email')->nullable();
			$table->string('mobile')->nullable();
			$table->string('password');
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'email']);
            $table->index(['deleted_at', 'mobile']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('t_enjoyers');
	}
}
