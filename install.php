<?php

use rexstan\RexCmd;
use rexstan\RexStanUserConfig;

$addon = rex_addon::get('rexstan');

if (isset($REX['PATH_PROVIDER'])) {
    $addon->setProperty('installmsg', 'Using rexstan in a setup with a custom PATH_PROVIDER is not supported.');
    return;
}

require_once __DIR__ .'/lib/RexCmd.php';
$cliPhpVersion = RexCmd::getCliPhpVersion();
if ($cliPhpVersion !== null) {
    if ($cliPhpVersion < 70300) {
        if (DIRECTORY_SEPARATOR === '\\') {
            $cliPhpPath = RexCmd::execCmd('where php', $stderrOutput, $exitCode);
        } else {
            $cliPhpPath = RexCmd::execCmd('which php', $stderrOutput, $exitCode);
        }

        $addon->setProperty('installmsg', 'PHP CLI version '.$cliPhpVersion.' on path "'. $cliPhpPath .'" is too old. Please upgrade to PHP 7.3+.');
        return;
    }
} else {
    $addon->setProperty('installmsg', 'Unable to determine PHP CLI version. Make sure PHP is installed in the CLI and availabe within your system PATH.');
    return;
}

$userConfigPath = $addon->getDataPath('user-config.neon');
if (!is_file($userConfigPath)) {
    $paths = [];

    $projectAddon = rex_addon::get('project');
    if ($projectAddon->getPath()) {
        $paths[] = $projectAddon->getPath();
    } else {
        $availableAddons = rex_addon::getAvailableAddons();
        foreach ($availableAddons as $availableAddon) {
            if ($availableAddon->isSystemPackage()) {
                continue;
            }

            if ('rexstan' == $availableAddon->getName()) {
                continue;
            }

            $paths[] = $availableAddon->getPath();
        }
    }

    RexStanUserConfig::save(0, $paths, [], 70300);
}
if (rex_version::compare(rex::getVersion(), '5.15.0-dev', '>=')) {
    $configFileContent = '# rexstan auto generated file - do not edit, delete, rename'. PHP_EOL . PHP_EOL .
        'includes:'. PHP_EOL .
        '    - ' . $addon->getPath('default-config.neon') . PHP_EOL .
        '    - ' . $addon->getPath('config/_from-r5_15.neon') . PHP_EOL .
        '    - ' . $userConfigPath. PHP_EOL;
} else {
    $configFileContent = '# rexstan auto generated file - do not edit, delete, rename'. PHP_EOL . PHP_EOL .
        'includes:'. PHP_EOL .
        '    - ' . $addon->getPath('default-config.neon') . PHP_EOL .
        '    - ' . $addon->getPath('config/_up-to-r5_14.neon') . PHP_EOL .
        '    - ' . $userConfigPath. PHP_EOL;
}

rex_dir::create($addon->getCachePath());
$configFileContent .= PHP_EOL .'parameters:'. PHP_EOL .
'    tmpDir: '.$addon->getCachePath() . PHP_EOL;

$configPath = __DIR__.'/phpstan.neon';
if (false === rex_file::put($configPath, $configFileContent)) {
    $addon->setProperty('installmsg', sprintf('Unable to write rexstan config "%s"', $configPath));
}

// make sure the binaries are executable
$binaries = glob(__DIR__.'/vendor/bin/*', GLOB_NOSORT);
if ($binaries !== false) {
    foreach ($binaries as $binaryPath) {
        @chmod($binaryPath, 0775);
    }
}
