<?php
declare(strict_types = 1);

namespace Spaze\PHPStan\Rules\Disallowed\Params;

use PHPStan\Type\Type;
use Spaze\PHPStan\Rules\Disallowed\Exceptions\UnsupportedParamTypeException;

interface DisallowedCallParam
{

	/**
	 * @throws UnsupportedParamTypeException
	 */
	public function matches(Type $type): bool;


	public function getPosition(): ?int;


	public function getName(): ?string;


	/**
	 * @return int|bool|string|null
	 */
	public function getValue();

}
