<?php

interface BookInterface {

	public function open();

	public function turnPage();
}

interface eReaderInterface {

	public function turnOn();

	public function pressNextButton();
}

class eReaderAdaptor implements BookInterface {

	private $reader;

	public function __construct(eReaderInterface $reader)
	{
		$this->reader = $reader;
	}

	public function open()
	{
		$this->reader->turnOn();
	}

	public function turnPage()
	{
		$this->reader->pressNextButton();
	}

}

class Kindle implements eReaderInterface {

	public function turnOn()
	{
		var_dump('turn on the kindle');
	}

	public function pressNextButton()
	{
		var_dump('press the next button of the kindle');
	}
}

class Book implements BookInterface {

	public function open()
	{
		var_dump('opening the paper book');
	}

	public function turnPage()
	{
		var_dump('turning the page of the paper book');
	}
}

class Person {

	public function read(BookInterface $book)
	{
		$book->open();
		$book->turnPage();
	}
}

(new Person)->read(new eReaderAdaptor(new Kindle));