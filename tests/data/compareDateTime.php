<?php

namespace CompareDateTimes;

class Foo
{

	public function test(
		\stdClass $a,
		\DateTime $b,
		\DateTime $c
	)
	{
		$a === 'foo';
		$b == $c;
		$b === $c;
		$b !== $c;
	}

}
