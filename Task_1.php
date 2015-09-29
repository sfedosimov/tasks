<?php

class ShapeAbstract 
{
	public $params;

	public function __construct($params) 
	{
		$this->params = $params;
	}

	public function make(IFormat $formatMaker) 
	{
		return $formatMaker->make($this);
	}
}

interface IFormat
{
	public function make(ShapeAbstract $shape);
}

class Circle extends ShapeAbstract 
{
	//...
}

class Square extends ShapeAbstract 
{
	//...
}

class Image implements IFormat
{
	public function make(ShapeAbstract $shape) 
	{
		//$res = $this->paint($shape->params)
		$res = $shape->params;
		echo 'Image Format: ';
		return $res;
	}
}


class ArrayPoints implements IFormat
{
	public function make(ShapeAbstract $shape) 
	{
		//$res = $this->calculatePoints($shape->params)
		$res = $shape->params;
		echo 'ArrayPoints Format: ';
		return $res;
	}
}


class Controller
{
	public function indexAction($shapes) 
	{
		foreach($shapes as $shape) {
			$class = $shape['type'];
			$params = $shape['params'];
			$format = array_shift($params);
			
			$res = (new $class($params))->make(new $format());
			
			echo print_r($res, true), "<br>";
		}
	}
}


$shapes = [
    ['type' => 'circle', 'params' => ['ArrayPoints',2,3]],
    ['type' => 'circle', 'params' => ['Image',2,1]]
];


(new Controller())->indexAction($shapes);

