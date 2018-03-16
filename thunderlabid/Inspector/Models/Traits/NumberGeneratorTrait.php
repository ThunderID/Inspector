<?php

namespace Thunderlabid\Inspector\Models\Traits;

/**
 * Trait Link list
 *
 * Digunakan untuk initizialize link list mode
 *
 * @package    TTagihan
 * @author     C Mooy <chelsymooy1108@gmail.com>
 */
trait NumberGeneratorTrait {
 	 	
	/**
	 * Add Event_list to queue
	 * @param [IEvent_list] $event_list 
	 */
	public function random(int $digit = 1)
	{
		foreach (range(0, max(1, $digit)) as $k) {
			$nomor[$k] 	= substr(md5(microtime()), rand(0,26) ,5);
		}

		return implode('', $nomor);
	}


	/**
	 * Add Event_list to queue
	 * @param [IEvent_list] $event_list 
	 */
	public function structured($field, $prefix)
	{
		$model 			= new get_class($this);

		$model 			= $model->where($field, 'like', $prefix.'%')->count();

		$last_letter	= str_pad(($model + 1), 3, '0', STR_PAD_LEFT);

		return $prefix.'-'.$last_letter;
	}
}