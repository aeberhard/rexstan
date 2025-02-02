<?php

declare(strict_types=1);

namespace TomasVotruba\UnusedPublic\Collectors;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Collectors\Collector;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\ReflectionProvider;
use TomasVotruba\UnusedPublic\ClassMethodCallReferenceResolver;
use TomasVotruba\UnusedPublic\Configuration;
use TomasVotruba\UnusedPublic\Enum\ReferenceMarker;
use TomasVotruba\UnusedPublic\ValueObject\MethodCallReference;

/**
 * @implements Collector<MethodCall, array<string>|null>
 */
final class MethodCallCollector implements Collector
{
    /**
     * @readonly
     * @var \PHPStan\Reflection\ReflectionProvider
     */
    private $reflectionProvider;

    /**
     * @readonly
     * @var \TomasVotruba\UnusedPublic\ClassMethodCallReferenceResolver
     */
    private $classMethodCallReferenceResolver;

    /**
     * @readonly
     * @var \TomasVotruba\UnusedPublic\Configuration
     */
    private $configuration;

    public function __construct(
        ReflectionProvider $reflectionProvider,
        ClassMethodCallReferenceResolver $classMethodCallReferenceResolver,
        Configuration $configuration
    ) {
        $this->reflectionProvider = $reflectionProvider;
        $this->classMethodCallReferenceResolver = $classMethodCallReferenceResolver;
        $this->configuration = $configuration;
    }

    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @param MethodCall $node
     * @return string[]|null
     */
    public function processNode(Node $node, Scope $scope): ?array
    {
        if (! $this->configuration->shouldCollectMethods()) {
            return null;
        }

        // skip calls in tests, as they are not used in production
        $classReflection = $scope->getClassReflection();
        if ($classReflection instanceof ClassReflection && $classReflection->isSubclassOf(
            'PHPUnit\Framework\TestCase'
        )) {
            return null;
        }

        // unable to resolve method name
        if ($node->name instanceof Expr) {
            return null;
        }

        $classMethodCallReference = $this->classMethodCallReferenceResolver->resolve($node, $scope);
        if (! $classMethodCallReference instanceof MethodCallReference) {
            return null;
        }

        $className = $classMethodCallReference->getClass();
        $methodName = $classMethodCallReference->getMethod();

        $classMethodReferences = $this->findParentClassMethodReferences($className, $methodName);

        $classMethodReference = $className . '::' . $methodName;
        if ($classMethodCallReference->isLocal()) {
            $classMethodReference = ReferenceMarker::LOCAL . $classMethodReference;
        }

        $classMethodReferences[] = $classMethodReference;

        return $classMethodReferences;
    }

    /**
     * @return string[]
     */
    private function findParentClassMethodReferences(string $className, string $methodName): array
    {
        if (! $this->reflectionProvider->hasClass($className)) {
            return [];
        }

        $classReflection = $this->reflectionProvider->getClass($className);

        $classMethodReferences = [];
        foreach ($classReflection->getParents() as $parentClassReflection) {
            if ($parentClassReflection->hasNativeMethod($methodName)) {
                $classMethodReferences[] = $parentClassReflection->getName() . '::' . $methodName;
            }
        }

        return $classMethodReferences;
    }
}
