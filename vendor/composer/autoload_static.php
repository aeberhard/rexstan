<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d28987f5749c840ef9609f53969aebc
{
    public static $files = array (
        '9b38cf48e83f5d8f60375221cd213eee' => __DIR__ . '/..' . '/phpstan/phpstan/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'staabm\\PHPStanDba\\' => 18,
        ),
        'P' => 
        array (
            'PHPStan\\' => 8,
        ),
        'C' => 
        array (
            'Composer\\Semver\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'staabm\\PHPStanDba\\' => 
        array (
            0 => __DIR__ . '/..' . '/staabm/phpstan-dba/src',
        ),
        'PHPStan\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpstan/phpstan-deprecation-rules/src',
            1 => __DIR__ . '/..' . '/phpstan/phpstan-phpunit/src',
            2 => __DIR__ . '/..' . '/phpstan/phpstan-strict-rules/src',
            3 => __DIR__ . '/..' . '/phpstan/phpstan-symfony/src',
        ),
        'Composer\\Semver\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/semver/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'RexStan' => __DIR__ . '/../..' . '/lib/RexStan.php',
        'RexStanUserConfig' => __DIR__ . '/../..' . '/lib/RexStanUserConfig.php',
        'redaxo\\phpstan\\RexClassDynamicReturnTypeExtension' => __DIR__ . '/../..' . '/lib/RexClassDynamicReturnTypeExtension.php',
        'redaxo\\phpstan\\RexFunctionsDynamicReturnTypeExtension' => __DIR__ . '/../..' . '/lib/RexFunctionsDynamicReturnTypeExtension.php',
        'redaxo\\phpstan\\RexSqlDynamicReturnTypeExtension' => __DIR__ . '/../..' . '/lib/RexSqlDynamicReturnTypeExtension.php',
        'redaxo\\phpstan\\RexSqlGetValueDynamicReturnTypeExtension' => __DIR__ . '/../..' . '/lib/RexSqlGetValueDynamicReturnTypeExtension.php',
        'redaxo\\phpstan\\RexSqlSetQueryTypeSpecifyingExtension' => __DIR__ . '/../..' . '/lib/RexSqlSetQueryTypeSpecifyingExtension.php',
        'rexstan_command' => __DIR__ . '/../..' . '/lib/command.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d28987f5749c840ef9609f53969aebc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d28987f5749c840ef9609f53969aebc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7d28987f5749c840ef9609f53969aebc::$classMap;

        }, null, ClassLoader::class);
    }
}
