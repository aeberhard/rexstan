<?php

namespace rexstan;

use rex_addon;
use rex_file;
use rex_package;
use rex_path;
use rex_string;
use RuntimeException;

final class RexStanUserConfig
{
    /**
     * Cache key to invalidate the summary signature in case of default-config.neon changes.
     */
    private const DEFAULT_SETTINGS_VERSION = 'v2-type-coverage-only-in-summary';

    /**
     * @param list<string> $paths
     * @param list<string> $includes
     *
     * @return void
     */
    public static function save(int $level, array $paths, array $includes, int $phpVersion)
    {
        $scanDirectories = [];
        foreach (rex_package::getAvailablePackages() as $package) {
            $functionsPath = $package->getPath('functions/');
            if (is_dir($functionsPath)) {
                $scanDirectories[] = $functionsPath;
            }
        }

        $file = [];
        $file['includes'] = $includes;
        $file['parameters']['level'] = $level;
        $file['parameters']['paths'] = $paths;
        $file['parameters']['scanDirectories'] = $scanDirectories;
        $file['parameters']['phpVersion'] = $phpVersion;

        $prefix = "# rexstan auto generated file - do not edit, rename or remove\n\n";

        rex_file::put(self::getUserConfigPath(), $prefix . rex_string::yamlEncode($file, 3));
    }

    public static function isBaselineEnabled(): bool
    {
        $includes = self::getConfig()['includes'];
        $baselineFile = RexStanSettings::getAnalysisBaselinePath();

        foreach($includes as $include) {
            if ($include === $baselineFile) {
                return true;
            }
        }

        return false;
    }

    public static function getLevel(): int
    {
        return (int) (self::getConfig()['parameters']['level']);
    }

    public static function getPhpVersion(): int
    {
        return (int) (self::getConfig()['parameters']['phpVersion']);
    }

    /**
     * @return list<string>
     */
    public static function getPaths(): array
    {
        return self::getConfig()['parameters']['paths'] ?? [];
    }

    /**
     * @return non-empty-string
     */
    public static function getSignature(): string
    {
        $md5 = md5_file(self::getUserConfigPath());
        if (!$md5) {
            throw new \PHPStan\ShouldNotHappenException();
        }
        return self::DEFAULT_SETTINGS_VERSION.'-'.$md5;
    }

    /**
     * @return array<string, mixed>
     */
    private static function getConfig(): array
    {
        $neon = self::readUserConfig();
        $userConf = rex_string::yamlDecode($neon);

        $neon = rex_file::get(rex_path::addon('rexstan', 'default-config.neon'), '');
        $defaultConf = rex_string::yamlDecode($neon);

        return $userConf + $defaultConf;
    }

    private static function readUserConfig(): string
    {
        $neon = rex_file::get(self::getUserConfigPath());

        if (null === $neon) {
            throw new RuntimeException('Unable to read userconfig');
        }

        return $neon;
    }

    private static function getUserConfigPath(): string
    {
        return rex_addon::get('rexstan')->getDataPath('user-config.neon');
    }

    public static function getAddOns(): string
    {
        $scanTargets = [];
        foreach (self::getPaths() as $scanpath) {
            foreach (rex_addon::getAvailableAddons() as $availableAddon) {
                if (pathinfo($scanpath)['basename'] === $availableAddon->getName()) {
                    $scanTargets[] = $availableAddon->getName();
                    break;
                }
                if (isset(pathinfo($scanpath)['dirname']) && pathinfo(pathinfo($scanpath)['dirname'])['basename'] === 'developer') {
                    if (pathinfo($scanpath)['basename'] === 'modules' || pathinfo($scanpath)['basename'] === 'templates') {
                        $scanTargets[] = 'developer:' . pathinfo($scanpath)['basename'];
                        break;
                    }
                }
            }
        }
        $addons = implode(', ', $scanTargets);
        return $addons;
    }

    public static function getExtensions(): string
    {
        $extensions = [];
        $config_extensions = self::getConfig()['includes'] ?? [];
        foreach ((array) $config_extensions as $extpath) {
            foreach (RexStanSettings::$phpstanExtensions as $label => $path) {
                if (pathinfo($extpath)['basename'] === pathinfo($path)['basename']) {
                    $extensions[] = $label;
                    break;
                }
            }
        }
        $extensions = implode(', ', $extensions);
        return $extensions;
    }
}
