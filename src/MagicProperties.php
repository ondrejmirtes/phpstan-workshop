<?php

namespace PhpStanWorkshop;

abstract class MagicProperties
{

	public function __get($name)
	{
		$methodName = 'get' . ucfirst($name);
		if (!method_exists($this, $methodName)) {
			throw new \Exception('Method ' . $methodName . '() does not exist.');
		}

		return $this->{$methodName}();
	}

}
