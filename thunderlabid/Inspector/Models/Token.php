<?php

namespace Thunderlabid\Inspector\Models;

///////////////
// Exception //
///////////////
use App\Exceptions\AppException;

////////////
// EVENTS //
////////////
use Thunderlabid\Inspector\Events\Token\TokenCreated;
use Thunderlabid\Inspector\Events\Token\TokenCreating;
use Thunderlabid\Inspector\Events\Token\TokenUpdated;
use Thunderlabid\Inspector\Events\Token\TokenUpdating;
use Thunderlabid\Inspector\Events\Token\TokenDeleted;
use Thunderlabid\Inspector\Events\Token\TokenDeleting;
use Thunderlabid\Inspector\Events\Token\TokenRestored;
use Thunderlabid\Inspector\Events\Token\TokenRestoring;

use Thunderlabid\Inspector\Models\Traits\FakturTrait;

class Token extends Model
{
	use FakturTrait;
	
	protected $table 	= 't_tokens';
	protected $fillable = ['enjoyer_id', 'token', 'sent_to', 'scope', 'expired_at', 'clicked_at'];
	protected $hidden 	= [];
	protected $appends	= [];
	protected $dates	= ['expired_at', 'clicked_at'];

	protected $rules	= [];
	protected $errors;

	protected $events = [
		'created' 	=> TokenCreated::class,
		'creating' 	=> TokenCreating::class,
		'updated' 	=> TokenUpdated::class,
		'updating' 	=> TokenUpdating::class,
		'deleted' 	=> TokenDeleted::class,
		'deleting' 	=> TokenDeleting::class,
		'restoring' => TokenRestoring::class,
		'restored' 	=> TokenRestored::class,
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
	public function enjoyer(){
		return $this->belongsto(Enjoyer::class);
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
		$rules['enjoyer_id']	= ['required', 'exists:t_enjoyers,id'];
		$rules['token']			= ['required', 'unique:t_tokens,token'];
		$rules['sent_to']		= ['required'];
		$rules['scope']			= ['required'];
		$rules['expired_at']	= ['date_format:"Y-m-d H:i:s"'];
		$rules['clicked_at']	= ['date_format:"Y-m-d H:i:s"'];

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
