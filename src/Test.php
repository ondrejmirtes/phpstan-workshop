<?php

namespace PhpStanWorkshop;

class Test
{

	/** @var string */
	private $foo;

	public function __construct(string $foo)
	{
		$this->foo = $foo;
	}

	public function setFoo(string $foo): void
	{
		$this->foo = $foo;
	}

}
