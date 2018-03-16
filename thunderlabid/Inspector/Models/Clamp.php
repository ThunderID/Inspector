<?php

namespace Thunderlabid\Inspector\Models;

///////////////
// Exception //
///////////////
use App\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Inspector\Events\Clamp\ClampCreated;
use Thunderlabid\Inspector\Events\Clamp\ClampCreating;
use Thunderlabid\Inspector\Events\Clamp\ClampUpdated;
use Thunderlabid\Inspector\Events\Clamp\ClampUpdating;
use Thunderlabid\Inspector\Events\Clamp\ClampDeleted;
use Thunderlabid\Inspector\Events\Clamp\ClampDeleting;
use Thunderlabid\Inspector\Events\Clamp\ClampRestored;
use Thunderlabid\Inspector\Events\Clamp\ClampRestoring;

use Thunderlabid\Inspector\Models\Traits\NumberGeneratorTrait;

class Clamp extends Model
{
	use NumberGeneratorTrait;
	
	protected $table 	= 't_clamps';
	protected $fillable = ['group_id', 'machine_id', 'key', 'secret', 'is_allowed'];
	protected $hidden 	= [];
	protected $appends	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;

	protected $events = [
		'created' 	=> ClampCreated::class,
		'creating' 	=> ClampCreating::class,
		'updated' 	=> ClampUpdated::class,
		'updating' 	=> ClampUpdating::class,
		'deleted' 	=> ClampDeleted::class,
		'deleting' 	=> ClampDeleting::class,
		'restoring' => ClampRestoring::class,
		'restored' 	=> ClampRestored::class,
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
	public function machine(){
		return $this->belongsto(Machine::class);
	}

	public function group(){
		return $this->belongsto(Group::class);
	}

	// ------------------------------------------------------------------------------------------------------------
	// FUNCTION
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// SCOPE
	// ------------------------------------------------------------------------------------------------------------

	// ------------------------------------------------------------------------------------------------------------
	// MUTATOR
	// ------------------------------------------------------------------------------------------------------------
	public function setKeyAttribute($var)
	{
		if(is_null($var)){
			$var		= $this->random(32);
		}

		$this->attributes['key'] 	= $var;
	}

	public function setSecretAttribute($var)
	{
		if(is_null($var)){
			$var		= $this->random(32);
		}

		$this->attributes['secret'] = $var;
	}

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
		$rules['group_id'] 		= ['required', 'exists:t_groups,id'];
		$rules['machine_id'] 	= ['required', 'exists:t_machines,id'];
		$rules['key'] 			= ['required'];
		$rules['secret'] 		= ['required'];
		$rules['is_allowed'] 	= ['required'];

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
