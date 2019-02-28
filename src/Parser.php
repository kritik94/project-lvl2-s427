<?php

namespace DiffCalculator\Parser;

use Exception;
use Symfony\Component\Yaml\Yaml;

function parseFromFile($filepath)
{
    $parts = explode('.', $filepath);
    $extension = $parts[count($parts) - 1];

    $content = file_get_contents($filepath);

    return parse($content, $extension);
}

function parse($content, $format)
{
    switch ($format) {
        case 'json':
            return json_decode($content, true);
        case 'yml':
        case 'yaml':
            return Yaml::parse($content);
        default:
            throw new Exception('undefined format');
    }
}
