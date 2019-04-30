<?php declare(strict_types = 1);

namespace PhpStanWorkshop;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class CompareDateTimeRuleTest extends RuleTestCase
{
	protected function getRule(): Rule
	{
		return new CompareDateTimeRule();
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/compareDateTime.php'], [
			[
				'Cannot compare DateTime instances with ===.',
				16,
			],
			[
				'Cannot compare DateTime instances with !==.',
				17,
			],
		]);
	}

}
