<?php

namespace DiffCalculator\Reader;

use Exception;
use Symfony\Component\Yaml\Yaml;

function buildData($filepath)
{
    $parts = explode('.', $filepath);
    $extention = $parts[count($parts) - 1];

    switch ($extention) {
        case 'json':
            return json_decode(file_get_contents($filepath), true);
        case 'yml':
        case 'yaml':
            return Yaml::parseFile($filepath);
        default:
            throw new Exception('undefined format');
    }
}
