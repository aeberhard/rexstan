<?php

declare(strict_types=1);

namespace TomasVotruba\UnusedPublic\CollectorMapper;

use Nette\Utils\Arrays;
use TomasVotruba\UnusedPublic\Enum\ReferenceMarker;
use TomasVotruba\UnusedPublic\ValueObject\LocalAndExternalMethodCallReferences;

final class MethodCallCollectorMapper
{
    /**
     * @param array<string, mixed[]> $methodCallReferencesByFile
     * @param array<string, mixed[]> $staticCallReferencesByFile
     * @param array<string, mixed[]> $attributeCallReferencesByFile
     * @return string[]
     */
    public function mapToMethodCallReferences(
        array $methodCallReferencesByFile,
        array $staticCallReferencesByFile,
        array $attributeCallReferencesByFile
    ): array {
        $methodCallReferences = $this->mergeAndFlatten(
            $methodCallReferencesByFile,
            $staticCallReferencesByFile,
            $attributeCallReferencesByFile
        );
        // remove ReferenceMaker::LOCAL prefix
        return array_map(static function (string $methodCallReference): string {
            if (strncmp($methodCallReference, ReferenceMarker::LOCAL, strlen(ReferenceMarker::LOCAL)) === 0) {
                return substr($methodCallReference, strlen(ReferenceMarker::LOCAL));
            }

            return $methodCallReference;
        }, $methodCallReferences);
    }

    /**
     * @param array<string, mixed[]> $methodCallReferencesByFile
     * @param array<string, mixed[]> $staticCallReferencesByFile
     * @param array<string, mixed[]> $attributeCallReferencesByFile
     */
    public function mapToLocalAndExternal(
        array $methodCallReferencesByFile,
        array $staticCallReferencesByFile,
        array $attributeCallReferencesByFile
    ): LocalAndExternalMethodCallReferences {
        $methodCallReferences = $this->mergeAndFlatten(
            $methodCallReferencesByFile,
            $staticCallReferencesByFile,
            $attributeCallReferencesByFile
        );

        $localMethodCallReferences = [];
        $externalMethodCallReferences = [];

        foreach ($methodCallReferences as $methodCallReference) {
            if (strncmp($methodCallReference, ReferenceMarker::LOCAL, strlen(ReferenceMarker::LOCAL)) === 0) {
                $localMethodCallReferences[] = substr($methodCallReference, strlen(ReferenceMarker::LOCAL));
            } else {
                $externalMethodCallReferences[] = $methodCallReference;
            }
        }

        return new LocalAndExternalMethodCallReferences($localMethodCallReferences, $externalMethodCallReferences);
    }

    /**
     * @param array<string, mixed[]> $methodCallReferencesByFile
     * @param array<string, mixed[]> $staticCallReferencesByFile
     * @param array<string, mixed[]> $attributeCallReferencesByFile
     * @return string[]
     */
    private function mergeAndFlatten(
        array $methodCallReferencesByFile,
        array $staticCallReferencesByFile,
        array $attributeCallReferencesByFile
    ): array {
        return array_merge(
            Arrays::flatten($methodCallReferencesByFile),
            Arrays::flatten($staticCallReferencesByFile),
            Arrays::flatten($attributeCallReferencesByFile)
        );
    }
}
