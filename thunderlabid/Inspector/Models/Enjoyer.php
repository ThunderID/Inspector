<?php

namespace Thunderlabid\Inspector\Models;

///////////////
// Exception //
///////////////
use App\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerCreated;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerCreating;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerUpdated;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerUpdating;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerDeleted;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerDeleting;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerRestored;
use Thunderlabid\Inspector\Events\Enjoyer\EnjoyerRestoring;

use Hash;

class Enjoyer extends Model
{
	protected $table 	= 't_enjoyers';
	protected $fillable = ['email', 'mobile', 'password'];
	protected $hidden 	= [];
	protected $appends	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;

	protected $events = [
		'created' 	=> EnjoyerCreated::class,
		'creating' 	=> EnjoyerCreating::class,
		'updated' 	=> EnjoyerUpdated::class,
		'updating' 	=> EnjoyerUpdating::class,
		'deleted' 	=> EnjoyerDeleted::class,
		'deleting' 	=> EnjoyerDeleting::class,
		'restoring' => EnjoyerRestoring::class,
		'restored' 	=> EnjoyerRestored::class,
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
	public function setPasswordAttribute($var)
	{
		if(Hash::needsRehash($var)){
			$var	= Hash::make($var);
		}

		$this->attributes['password'] 	= $var;
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
		$rules['email'] 		= ['required_without:mobile', 'unique:t_enjoyers,email'];
		$rules['mobile'] 		= ['required_without:email', 'unique:t_enjoyers,mobile'];
		$rules['password'] 		= ['required'];

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
