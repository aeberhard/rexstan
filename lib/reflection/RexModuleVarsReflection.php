<?php

declare(strict_types=1);

namespace rexstan;

use rex_string;

final class RexModuleVarsReflection {
    /**
     * @param string $input
     * @return list<array{string, array<string, scalar>}>
     */
    static public function matchInputVars(string $input): array {
        if(preg_match_all('{(?P<var>REX_INPUT_VALUE|REX_VALUE|REX_LINK|REX_LINKLIST|REX_MEDIA|REX_MEDIALIST)\[(?P<args>[^\]]+)\]}', $input, $matches) !== false) {
            $result = [];
            for ($i = 0, $len = count($matches['var']); $i < $len; ++$i) {
                $args = rex_string::split($matches['args'][$i]);

                if (count($args) === 1 && array_key_exists(0, $args)) {
                    $args = ['id' => $args[0]]; // default arg is "id"
                }

                $result[] = [
                    $matches['var'][$i],
                    $args,
                ];
            }

            return $result;
        }

        return [];
    }

    /**
     * @param string $output
     * @return list<array{string, array<string, scalar>}>
     */
    static public function matchOutputVars(string $output): array {
        if(preg_match_all('{(?P<var>REX_VALUE|REX_LINK|REX_LINKLIST|REX_MEDIA|REX_MEDIALIST)\[(?P<args>[^\]]+)\]}', $output, $matches) !== false) {
            $result = [];
            for ($i = 0, $len = count($matches['var']); $i < $len; ++$i) {
                $args = rex_string::split($matches['args'][$i]);

                if (count($args) === 1 && array_key_exists(0, $args)) {
                    $args = ['id' => $args[0]]; // default arg is "id"
                }

                $result[] = [
                    $matches['var'][$i],
                    $args,
                ];
            }

            return $result;
        }

        return [];
    }

}
