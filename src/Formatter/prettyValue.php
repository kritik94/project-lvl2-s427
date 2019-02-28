<?php

namespace DiffCalculator\Formatter;

function prettyValue($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    return $value;
}
