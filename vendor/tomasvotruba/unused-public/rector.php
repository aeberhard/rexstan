<?php

declare(strict_types=1);

use Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->importNames();

    $rectorConfig->sets([
        \Rector\PHPUnit\Set\PHPUnitSetList::PHPUNIT_100,
        LevelSetList::UP_TO_PHP_81,
        SetList::TYPE_DECLARATION,
        SetList::PRIVATIZATION,
        SetList::NAMING,
        SetList::DEAD_CODE,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
    ]);

    $rectorConfig->ruleWithConfiguration(\Rector\Php55\Rector\String_\StringClassNameToClassConstantRector::class, [
        'Twig\Extension\ExtensionInterface',
        'PHPUnit\Framework\TestCase',
        'Symfony\Bundle\FrameworkBundle\Controller\Controller',
        'Symfony\Component\EventDispatcher\EventSubscriberInterface',
    ]);

    $rectorConfig->skip([
        '*/Fixture/*',
        '*/Source/*',

        VarConstantCommentRector::class => [
            __DIR__ . '/src/PublicClassMethodMatcher.php',
        ],
    ]);
};
