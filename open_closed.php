<?php

interface ShapeInterface {

	public function area();
}

class Square implements ShapeInterface {

	public $width;

	public $height;

	public function __construct($width, $height)
	{
		$this->width = $width;
		$this->height = $height;
	}

	public function area()
	{
		return $this->width * $this->height;
	}
}

class AreaCalculator {

	public function calculate($shapes)
	{
		foreach ($shapes as $shape) {

			$area[] = $shape->area();
		}

		return array_sum($area);
	}
}

$squares[] = new Square(3, 4);
$squares[] = new Square(2, 5);

$area = (new AreaCalculator)->calculate($squares);

echo $area;