<?php

namespace PhpStanWorkshop;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertyReflection;
use PHPStan\Type\Type;

class MagicPropertyReflection implements PropertyReflection
{

	/** @var ClassReflection */
	private $declaringClass;

	/** @var Type */
	private $type;

	public function __construct(ClassReflection $declaringClass, Type $type)
	{
		$this->declaringClass = $declaringClass;
		$this->type = $type;
	}

	public function getDeclaringClass(): ClassReflection
	{
		return $this->declaringClass;
	}

	public function isStatic(): bool
	{
		return false;
	}

	public function isPrivate(): bool
	{
		return false;
	}

	public function isPublic(): bool
	{
		return true;
	}

	public function getType(): Type
	{
		return $this->type;
	}

	public function isReadable(): bool
	{
		return true;
	}

	public function isWritable(): bool
	{
		return true;
	}

}
