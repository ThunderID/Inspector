<?php

namespace Thunderlabid\Inspector\Models;

///////////////
// Exception //
///////////////
use App\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Inspector\Events\Group\GroupCreated;
use Thunderlabid\Inspector\Events\Group\GroupCreating;
use Thunderlabid\Inspector\Events\Group\GroupUpdated;
use Thunderlabid\Inspector\Events\Group\GroupUpdating;
use Thunderlabid\Inspector\Events\Group\GroupDeleted;
use Thunderlabid\Inspector\Events\Group\GroupDeleting;
use Thunderlabid\Inspector\Events\Group\GroupRestored;
use Thunderlabid\Inspector\Events\Group\GroupRestoring;

use Thunderlabid\Inspector\Models\Traits\NumberGeneratorTrait;

class Group extends Model
{
	use NumberGeneratorTrait;
	
	protected $table 	= 't_groups';
	protected $fillable = ['nama', 'gif_number'];
	protected $hidden 	= [];
	protected $appends	= [];
	protected $dates	= [];

	protected $rules	= [];
	protected $errors;

	protected $events = [
		'created' 	=> GroupCreated::class,
		'creating' 	=> GroupCreating::class,
		'updated' 	=> GroupUpdated::class,
		'updating' 	=> GroupUpdating::class,
		'deleted' 	=> GroupDeleted::class,
		'deleting' 	=> GroupDeleting::class,
		'restoring' => GroupRestoring::class,
		'restored' 	=> GroupRestored::class,
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
	public function setGifNumberAttribute($var)
	{
		$prefix 	= date('ymd').'.CONSUMER.TLAB.';

		if(is_null($var)){
			$var	= $this->structured('gif_number', $prefix);
		}

		$this->attributes['gif_number'] 	= $var;
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
		$rules['nama'] 			= ['required'];
		$rules['gif_number']	= ['required', 'unique:t_groups,gif_number'];

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
