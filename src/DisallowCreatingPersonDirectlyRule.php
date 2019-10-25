<?php

namespace PhpStanWorkshop;

use PhpParser\Node;
use PHPStan\Analyser\Scope;

class DisallowCreatingPersonDirectlyRule implements \PHPStan\Rules\Rule
{

	public function getNodeType(): string
	{
		return Node\Expr\New_::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\New_ $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!$node->class instanceof Node\Name) {
			return [];
		}

		$className = $node->class->toString();
		if ($className !== \PhpStanWorkshop\Person::class) {
			return [];
		}

		if ($scope->isInClass()) {
			assert($scope->getClassReflection() !== null);
			$inClassName = $scope->getClassReflection()->getName();
			if ($inClassName === PersonFactory::class) {
				return [];
			}
		}

		return [
			'Do not call new Person() directly; User PersonFactory::create() instead.',
		];
	}

}
