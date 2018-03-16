<?php

use Illuminate\Database\Seeder;

use Thunderlabid\Inspector\Models\Enjoyer;
use Thunderlabid\Inspector\Models\Group;
use Thunderlabid\Inspector\Models\Machine;
use Thunderlabid\Inspector\Models\Clamp;
use Thunderlabid\Inspector\Models\Scope;

class LoginTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('t_clamps')->truncate();
		DB::table('t_enjoyers')->truncate();
		DB::table('t_groups')->truncate();
		DB::table('t_machines')->truncate();
		DB::table('t_scopes')->truncate();
		DB::table('t_tokens')->truncate();

		//store enjoyer
		$enj 			= new Enjoyer;
		$enj->email 	= 'chelsy@thunderlab.id';
		$enj->password 	= 'adminadmin';
		$enj->save();

		//store group
		$gro 			= new Group;
		$gro->nama 		= 'GOKREDIT';
		$gro->save();

		//store machine
		$mac 			= new Machine;
		$mac->nama 		= 'Thunder SMS Gateway';
		$mac->jenis 	= 'web';
		$mac->kategori 	= 'gateway';
		$mac->save();

		//store clams
		$cl 			= new Clamp;
		$cl->group_id 	= $gro->id;
		$cl->machine_id = $mac->id;
		$cl->save();
	
		//store scopes
		$sc 			= new Scope;
		$sc->enjoyer_id	= $enj->id;
		$sc->group_id	= $gro->id;
		$sc->scopes 	= ['sms'];
		$sc->save();
	}
}
