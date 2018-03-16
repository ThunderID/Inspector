<?php

namespace App\Helpers\Traits;

/**
 * Trait Link list
 *
 * Digunakan untuk initizialize link list mode
 *
 * @package    TTagihan
 * @author     C Mooy <chelsymooy1108@gmail.com>
 */
trait TextTrait {
 	 	
	/**
	 * Add Event_list to queue
	 * @param [IEvent_list] $event_list 
	 */
	public function ArrayToJson(array $var)
	{
		return json_encode($var);
	}

	/**
	 * Add Event_list to queue
	 * @param [IEvent_list] $event_list 
	 */
	public function JsonToArray($var)
	{
		return json_decode($var, true);
	}
}