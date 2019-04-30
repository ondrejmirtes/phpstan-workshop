<?php declare(strict_types = 1);

namespace PhpStanWorkshop;

use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Type\ObjectType;

class CompareDateTimeRule implements Rule
{

	public function getNodeType(): string
	{
		return BinaryOp::class;
	}

	/**
	 * @param \PhpParser\Node\Expr\BinaryOp $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return string[]
	 */
	public function processNode(Node $node, Scope $scope): array
	{
		if (!$node instanceof BinaryOp\Identical && !$node instanceof BinaryOp\NotIdentical) {
			return [];
		}

		$leftType = $scope->getType($node->left);
		$rightType = $scope->getType($node->right);
		$dateTimeType = new ObjectType(\DateTimeInterface::class);

		if ($dateTimeType->isSuperTypeOf($leftType)->yes() || $dateTimeType->isSuperTypeOf($rightType)->yes()) {
			return [
				sprintf('Cannot compare DateTime instances with %s.', $node->getOperatorSigil()),
			];
		}

		return [];
	}

}
