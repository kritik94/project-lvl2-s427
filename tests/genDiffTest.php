<?php

namespace DiffCalculator\Tests;

use PHPUnit\Framework\TestCase;

class DiffTest extends TestCase
{
    /**
     * @dataProvider exampleProvider
     **/
    public function testLinearDiff($beforeFilepath, $afterFilepath, $resultFilepath): void
    {
        $expect = file_get_contents($resultFilepath);
        $actual = \DiffCalculator\Diff\genDiff($beforeFilepath, $afterFilepath);

        $this->assertEquals($expect, $actual);
    }

    public function exampleProvider()
    {
        return [
            [
                __DIR__ . '/examples/example1-before.json',
                __DIR__ . '/examples/example1-after.json',
                __DIR__ . '/examples/example1-result',
            ],
            [
                __DIR__ . '/examples/example1-before.yml',
                __DIR__ . '/examples/example1-after.yml',
                __DIR__ . '/examples/example1-result',
            ],
        ];
    }
}
