<?php

namespace Thunderlabid\Inspector\Models;

///////////////
// Exception //
///////////////
use App\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Inspector\Events\Machine\MachineCreated;
use Thunderlabid\Inspector\Events\Machine\MachineCreating;
use Thunderlabid\Inspector\Events\Machine\MachineUpdated;
use Thunderlabid\Inspector\Events\Machine\MachineUpdating;
use Thunderlabid\Inspector\Events\Machine\MachineDeleted;
use Thunderlabid\Inspector\Events\Machine\MachineDeleting;
use Thunderlabid\Inspector\Events\Machine\MachineRestored;
use Thunderlabid\Inspector\Events\Machine\MachineRestoring;

class Machine extends Model
{
	protected $table 	= 't_machines';
	protected $fillable = ['nama', 'jenis', 'kategori'];
	protected $hidden 	= [];
	protected $appends	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;

	protected $events = [
		'created' 	=> MachineCreated::class,
		'creating' 	=> MachineCreating::class,
		'updated' 	=> MachineUpdated::class,
		'updating' 	=> MachineUpdating::class,
		'deleted' 	=> MachineDeleted::class,
		'deleting' 	=> MachineDeleting::class,
		'restoring' => MachineRestoring::class,
		'restored' 	=> MachineRestored::class,
	];

	// ------------------------------------------------------------------------------------------------------------
	// CONSTRUCT
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// BOOT
	// ------------------------------------------------------------------------------------------------------------
	
	// ------------------------------------------------------------------------------------------------------------
	// RELATION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// ACCESSOR
	// ------------------------------------------------------------------------------------------------------------
	public function getIsDeletableAttribute()
	{
		return true;
	}

	public function getIsSavableAttribute()
	{
		//////////////////
		// Create Rules //
		//////////////////
		$rules['nama']		= ['required'];
		$rules['jenis']		= ['required'];
		$rules['kategori']	= ['required'];

		//////////////
		// Validate //
		//////////////
		$validator = Validator::make($this->attributes, $rules);
		if ($validator->fails())
		{
			$this->errors = $validator->messages();
			return false;
		}

		return true;
	}

	public function getErrorsAttribute()
	{
		return $this->errors;
	}
}
