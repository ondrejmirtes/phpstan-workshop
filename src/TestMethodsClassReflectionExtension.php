<?php

namespace PhpStanWorkshop;

use PHPStan\Analyser\OutOfClassScope;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Type\ObjectType;

class TestMethodsClassReflectionExtension implements MethodsClassReflectionExtension
{

	public function hasMethod(ClassReflection $classReflection, string $methodName): bool
	{
		if ($classReflection->getName() !== Test::class) {
			return false;
		}

		return $this->findMethod($methodName) !== null;
	}

	public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
	{
		$method = $this->findMethod($methodName);
		assert($method !== null);

		return $method;
	}

	private function findMethod(string $methodName): ?MethodReflection
	{
		$type = new ObjectType(Test2::class);
		if (!$type->hasMethod($methodName)->yes()) {
			return null;
		}

		return $type->getMethod($methodName, new OutOfClassScope());
	}

}
