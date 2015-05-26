<?php

interface Manageable {

	public function beManaged();
}

interface Sleepable {

	public function sleep();
}

interface Workable {

	public function work();
}

class HumanWorker implements Workable, Sleepable, Manageable {

	public function work()
	{
		var_dump('human working');
	}

	public function sleep()
	{
		var_dump('human sleeping');
	}

	public function beManaged()
	{
		$this->work();
		$this->sleep();
	}
}

class AndroidWorker implements Workable, Manageable {

	public function work()
	{
		var_dump('android working');
	}

	public function beManaged()
	{
		$this->work();
	}
}

class Captain {

	public function manage(Manageable $worker)
	{
		$worker->beManaged();
	}
}

(new Captain)->manage(new AndroidWorker);