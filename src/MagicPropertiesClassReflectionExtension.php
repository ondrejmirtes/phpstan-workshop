<?php

namespace PhpStanWorkshop;

use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\PropertiesClassReflectionExtension;
use PHPStan\Reflection\PropertyReflection;

class MagicPropertiesClassReflectionExtension implements PropertiesClassReflectionExtension
{

	public function hasProperty(ClassReflection $classReflection, string $propertyName): bool
	{
		$methodName = 'get' . ucfirst($propertyName);

		return $classReflection->hasNativeMethod($methodName);
	}

	public function getProperty(ClassReflection $classReflection, string $propertyName): PropertyReflection
	{
		$methodName = 'get' . ucfirst($propertyName);

		return new MagicPropertyReflection(
			$classReflection,
			$classReflection->getNativeMethod($methodName)->getVariants()[0]->getReturnType()
		);
	}

}
