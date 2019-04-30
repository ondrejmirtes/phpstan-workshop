<?php

namespace PhpStanWorkshop;

class Test2
{

	public function test(Test $test)
	{
		echo $test->name;
		echo $test->email;
	}

}
