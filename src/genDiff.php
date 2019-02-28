<?php

namespace DiffCalculator;

use function DiffCalculator\Reader\buildData;
use function DiffCalculator\Formatter\prettyValue;

function genDiff($beforeFilepath, $afterFilepath)
{
    $before = buildData($beforeFilepath);
    $after = buildData($afterFilepath);

    $merged = array_merge($before, $after);

    $diffInfo = array_map(function ($key) use ($merged, $before, $after) {
        $beforeHasKey = array_key_exists($key, $before);
        $afterHasKey = array_key_exists($key, $after);

        if ($beforeHasKey && !$afterHasKey) {
            return 'deleted';
        } elseif (!$beforeHasKey && $afterHasKey) {
            return 'added';
        } elseif ($before[$key] !== $after[$key]) {
            return 'changed';
        }

        return 'unchanged';
    }, array_keys($merged));

    $resultParts = array_map(function ($type, $key) use ($before, $after) {
        switch ($type) {
            case 'unchanged':
                return sprintf('    %s: %s', $key, prettyValue($before[$key]));
            case 'added':
                return sprintf('  + %s: %s', $key, prettyValue($after[$key]));
            case 'deleted':
                return sprintf('  - %s: %s', $key, prettyValue($before[$key]));
            case 'changed':
                return sprintf(
                    '  + %s: %s' . PHP_EOL . '  - %s: %s',
                    $key,
                    prettyValue($after[$key]),
                    $key,
                    prettyValue($before[$key])
                );
        }
    }, $diffInfo, array_keys($merged), $merged);

    return implode(PHP_EOL, array_merge(['{'], $resultParts, ['}']));
}
