<?php

namespace DiffCalculator\Format;

function prettifyValue($value)
{
    if (is_bool($value)) {
        return $value ? 'true' : 'false';
    }

    return $value;
}
