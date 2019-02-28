<?php

namespace DiffCalculator\Tests;

use PHPUnit\Framework\TestCase;

class GenDiffTest extends TestCase
{
    protected $expect = <<<DIFF
{
    host: hexlet.io
  + timeout: 20
  - timeout: 50
  - proxy: 123.234.53.22
  + verbose: true
}
DIFF;

    /**
     * @dataProvider exampleProvider
     **/
    public function testDiff($beforeFilepath, $afterFilepath): void
    {
        $actual = \DiffCalculator\Diff\genDiff($beforeFilepath, $afterFilepath);

        $this->assertEquals($this->expect, $actual);
    }

    public function exampleProvider()
    {
        return [
            [
                __DIR__ . '/examples/example1-before.json',
                __DIR__ . '/examples/example1-after.json'
            ],
            [
                __DIR__ . '/examples/example1-before.yml',
                __DIR__ . '/examples/example1-after.yml'
            ],
        ];
    }
}
