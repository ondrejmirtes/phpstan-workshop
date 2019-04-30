<?php

namespace PhpStanWorkshop;

class Test
{

	public function doFoo(ParameterBag $parameterBag)
	{
		$password = $parameterBag->getParameter('password');
		$this->requireString($password);
		$this->requireString($parameterBag->getParameter());
	}

	public function requireString(string $string)
	{

	}

}
