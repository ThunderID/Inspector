<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Artisan, DB;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class Release extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'inspector:release';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Release next iteration';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// $this->developing();

		$this->info("--------------------------------------------------------");
		$this->info('RELEASE V1');
		$this->info("--------------------------------------------------------");
		$this->v1();
		$this->info("\n--------------------------------------------------------");
		$this->info('DONE');
		$this->info("--------------------------------------------------------\n");

		$this->info("--------------------------------------------------------");
		$this->info('SEEDING');
		$this->info("--------------------------------------------------------");
		$this->seeding();
		$this->info("\n--------------------------------------------------------");
		$this->info('DONE');
		$this->info("--------------------------------------------------------\n");
	}

	public function v1()
	{
		Artisan::call('migrate:refresh', ['--path' => 'thunderlabid/Inspector/Migrations/']);
	}

	public function seeding(){
		Artisan::call('db:seed');
	}
}
