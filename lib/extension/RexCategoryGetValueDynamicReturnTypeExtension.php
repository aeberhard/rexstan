<?php

declare(strict_types=1);

namespace rexstan;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;
use rex_category;
use function count;
use function in_array;

final class RexCategoryGetValueDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return rex_category::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return in_array(strtolower($methodReflection->getName()), ['getvalue'], true);
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): ?Type {
        $args = $methodCall->getArgs();
        if (1 < count($args)) {
            return null;
        }

        $nameType = $scope->getType($args[0]->value);
        $valueReflection = new RexGetValueReflection();
        return $valueReflection->getValueType($nameType, $this->getClass());
    }
}
