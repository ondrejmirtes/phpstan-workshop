<?php

namespace PhpStanWorkshop;

class Test
{

	/** @var \PhpStanWorkshop\Test2 */
	private $object;

	public function __construct()
	{
		$this->object = new Test2();
	}

	public function __call($name, $args)
	{
		return $this->object->{$name}(...$args);
	}

	public function test()
	{
		$this->doFoo();
		$this->doBar();

		$this->doBar() === 1;
	}

}
