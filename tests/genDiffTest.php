<?php

namespace DiffCalculator\Tests;

use PHPUnit\Framework\TestCase;

class GenDiffTest extends TestCase
{
    public function testJsonDiff(): void
    {
        $beforeFilepath = __DIR__ . '/examples/example1-before.json';
        $afterFilepath = __DIR__ . '/examples/example1-after.json';

        $expect = <<<DIFF
{
    host: hexlet.io
  + timeout: 20
  - timeout: 50
  - proxy: 123.234.53.22
  + verbose: true
}
DIFF;

        $actual = \DiffCalculator\genDiff($beforeFilepath, $afterFilepath);

        $this->assertEquals($expect, $actual);
    }
}
