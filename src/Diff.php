<?php

namespace DiffCalculator\Diff;

use function DiffCalculator\Parser\parseFromFile;
use function DiffCalculator\Format\prettifyValue;

function genDiff($beforeFilepath, $afterFilepath)
{
    $before = parseFromFile($beforeFilepath);
    $after = parseFromFile($afterFilepath);

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
                return sprintf('    %s: %s', $key, prettifyValue($before[$key]));
            case 'added':
                return sprintf('  + %s: %s', $key, prettifyValue($after[$key]));
            case 'deleted':
                return sprintf('  - %s: %s', $key, prettifyValue($before[$key]));
            case 'changed':
                return sprintf(
                    '  + %s: %s' . PHP_EOL . '  - %s: %s',
                    $key,
                    prettifyValue($after[$key]),
                    $key,
                    prettifyValue($before[$key])
                );
        }
    }, $diffInfo, array_keys($merged), $merged);

    return implode(PHP_EOL, array_merge(['{'], $resultParts, ['}']));
}
