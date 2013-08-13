<?php namespace Justinhilles\Admin\Observers;

class UserObserver {

	public function saving($user)
	{
		var_dump($user);exit;
	}
}