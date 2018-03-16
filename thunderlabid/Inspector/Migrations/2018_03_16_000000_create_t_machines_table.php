<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMachinesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('t_machines', function (Blueprint $table) {
			$table->increments('id');
			$table->string('nama');
			$table->string('jenis');
			$table->string('kategori');
			$table->timestamps();
			$table->softDeletes();
			
            $table->index(['deleted_at', 'jenis', 'kategori']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('t_machines');
	}
}
