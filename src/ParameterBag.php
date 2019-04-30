<?php declare(strict_types = 1);

namespace PhpStanWorkshop;

class ParameterBag
{

	/** @var string[] */
	private $data = [
		'password' => 'foo',
	];

	/**
	 * @param string|null $key
	 * @return string|string[]
	 */
	public function getParameter(?string $key = null)
	{
		if ($key === null) {
			return $this->data;
		}

		return $this->data[$key];
	}

}
