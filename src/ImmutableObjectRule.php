<?php

namespace PhpStanWorkshop;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Rules\Rule;
use PHPStan\Type\VerbosityLevel;

class ImmutableObjectRule implements Rule
{

	/**
	 * @return string
	 */
	public function getNodeType(): string
	{
		return Node\Expr\Assign::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\Assign $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!$scope->isInClass()) {
			return [];
		}
		if (!$node->var instanceof Node\Expr\PropertyFetch) {
			return [];
		}
		if (!$node->var->name instanceof Node\Identifier) {
			return [];
		}
		$inMethod = $scope->getFunction();
		if (!$inMethod instanceof MethodReflection) {
			return [];
		}
		if ($inMethod->getName() === '__construct') {
			return [];
		}

		return [
			sprintf('Immutability violated - assigning $%s property outside constructor.', $node->var->name->toString()),
		];
	}

}
