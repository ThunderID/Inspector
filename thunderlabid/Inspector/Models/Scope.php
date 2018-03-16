<?php

namespace Thunderlabid\Inspector\Models;

///////////////
// Exception //
///////////////
use App\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Inspector\Events\Scope\ScopeCreated;
use Thunderlabid\Inspector\Events\Scope\ScopeCreating;
use Thunderlabid\Inspector\Events\Scope\ScopeUpdated;
use Thunderlabid\Inspector\Events\Scope\ScopeUpdating;
use Thunderlabid\Inspector\Events\Scope\ScopeDeleted;
use Thunderlabid\Inspector\Events\Scope\ScopeDeleting;
use Thunderlabid\Inspector\Events\Scope\ScopeRestored;
use Thunderlabid\Inspector\Events\Scope\ScopeRestoring;

use App\Helpers\Traits\TextTrait;

class Scope extends Model
{
	use TextTrait;
	
	protected $table 	= 't_scopes';
	protected $fillable = ['enjoyer_id', 'group_id', 'scopes'];
	protected $hidden 	= [];
	protected $appends	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;

	protected $events = [
		'created' 	=> ScopeCreated::class,
		'creating' 	=> ScopeCreating::class,
		'updated' 	=> ScopeUpdated::class,
		'updating' 	=> ScopeUpdating::class,
		'deleted' 	=> ScopeDeleted::class,
		'deleting' 	=> ScopeDeleting::class,
		'restoring' => ScopeRestoring::class,
		'restored' 	=> ScopeRestored::class,
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
	public function setScopesAttribute(array $var)
	{
		$this->attributes['scopes'] 	= $this->arraytojson($var);
	}

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
		$rules['enjoyer_id']	= ['required', 'exists:t_enjoyers,id'];
		$rules['group_id']		= ['required', 'exists:t_groups,id'];
		$rules['scopes']		= ['required'];

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

	public function getScopesAttribute($var)
	{
		return $this->jsontoarray($this->attributes['scopes']);
	}
}
