<?php

namespace PhpStanWorkshop;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;

class MagicPropertiesClassReflectionExtension implements PropertiesClassReflectionExtension
{

	public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
	{
		$traits = $classReflection->getTraits();
		return in_array(MagicAccessors::class, $traits, true) && $classReflection->hasNativeProperty($propertyName);
	}

	public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
	{
		$methodName = 'get' . ucfirst($propertyName);

		return new MagicPropertyReflection(
			$classReflection,
			$classReflection->getNativeProperty($propertyName)->getType()
		);
	}

}
