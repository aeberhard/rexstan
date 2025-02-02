<?php

declare(strict_types=1);

namespace Symplify\PHPStanRules\Collector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Collectors\Collector;
use Symplify\PHPStanRules\Matcher\ClassMethodCallReferenceResolver;
use Symplify\PHPStanRules\Printer\CollectorMetadataPrinter;
use Symplify\PHPStanRules\ValueObject\MethodCallReference;

/**
 * @implements Collector<MethodCall, array<string>|null>
 */
final class MethodCallArgTypesCollector implements Collector
{
    /**
     * @readonly
     * @var \Symplify\PHPStanRules\Matcher\ClassMethodCallReferenceResolver
     */
    private $classMethodCallReferenceResolver;
    /**
     * @readonly
     * @var \Symplify\PHPStanRules\Printer\CollectorMetadataPrinter
     */
    private $collectorMetadataPrinter;
    public function __construct(ClassMethodCallReferenceResolver $classMethodCallReferenceResolver, CollectorMetadataPrinter $collectorMetadataPrinter)
    {
        $this->classMethodCallReferenceResolver = $classMethodCallReferenceResolver;
        $this->collectorMetadataPrinter = $collectorMetadataPrinter;
    }
    public function getNodeType(): string
    {
        return MethodCall::class;
    }

    /**
     * @param MethodCall $node
     * @return array{string, string}|null
     */
    public function processNode(Node $node, Scope $scope): ?array
    {
        if ($node->getArgs() === []) {
            return null;
        }

        $classMethodCallReference = $this->classMethodCallReferenceResolver->resolve($node, $scope, true);
        if (! $classMethodCallReference instanceof MethodCallReference) {
            return null;
        }

        $className = $classMethodCallReference->getClass();
        $methodName = $classMethodCallReference->getMethod();

        $classMethodReference = $className . '::' . $methodName;

        $stringArgTypesString = $this->collectorMetadataPrinter->printArgTypesAsString($node, $scope);

        return [$classMethodReference, $stringArgTypesString];
    }
}
