<?php

namespace PhpStanWorkshop;

class PersonFactory
{

	public function create(): Person
	{
		return new Person();
	}
}
