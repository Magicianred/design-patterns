<?php

// Publisher
interface Subject {

	public function attach($observable);

	public function detach($index);

	public function notify();
}

// Subscriber
interface Observer {

	public function handle();
}

// Subscriber
class EmailNotifier implements Observer {

	public function handle()
	{
		var_dump('send an email');
	}
}

// Subscriber
class LogHandler implements Observer {

	public function handle()
	{
		var_dump('do some loggings');
	}
}

// Subscriber
class ReportHandler implements Observer {

	public function handle()
	{
		var_dump('do some reprting');
	}
}

// Publisher
class Login implements Subject {

	private $observers = [];

	public function attach($observable)
	{
		if (is_array($observable)) {

			$this->attachObservers($observable);

			return;
		}

		$this->observers[] = $observable;

		return $this;
	}

	public function detach($index)
	{
		unset($this->observers[$index]);
	}

	public function notify()
	{
		foreach ($this->observers as $observer) {
			$observer->handle();
		}
	}

	public function fire()
	{
		$this->notify();
	}

	private function attachObservers($observable)
	{
		foreach ($observable as $observer) {

			if ( ! $observer instanceof Observer)
				
				throw new Exception('Not an observer');

			$this->attach($observer);
		}
	}
}

$login = new Login;
$login->attach([
	new EmailNotifier,
	new LogHandler,
	new ReportHandler
]);

$login->fire();