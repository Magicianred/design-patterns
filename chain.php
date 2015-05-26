<?php

abstract class HomeChecker {

	protected $successor;

	abstract public function check(HomeStatus $home);

	public function succeedWith(HomeChecker $successor)
	{
		$this->successor = $successor;
	}

	public function next(HomeStatus $home)
	{
		if ($this->successor)

			$this->successor->check($home);
	}
}

class Lock extends HomeChecker {

	public function check(HomeStatus $home)
	{
		if ( ! $home->locked)

			throw new Exception('Doors are not locked. Abort! Abort!');

		$this->next($home);
	}
}

class Alarm extends HomeChecker {

	public function check(HomeStatus $home)
	{
		if ( ! $home->alarmOn)

			throw new Exception('Alarms are not on. Abort! Abort!');

		$this->next($home);
	}
}

class Light extends HomeChecker {

	public function check(HomeStatus $home)
	{
		if ( ! $home->lightOff)

			throw new Exception('Lights are not off. Abort! Abort!');

		$this->next($home);
	}
}

class HomeStatus {

	public $locked = true;

	public $alarmOn = true;

	public $lightOff = true;
}

$lock = new Lock;
$alarm = new Alarm;
$light = new Light;

$lock->succeedWith($alarm);
$alarm->succeedWith($light);

$lock->check(new HomeStatus);