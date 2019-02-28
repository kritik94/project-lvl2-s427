<?php

namespace DiffCalculator\Main;

use Docopt;
use function DiffCalculator\Diff\genDiff;

const DOCOPT = <<<DOC
Generate diff

Usage:
  gendiff (-h|--help)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help                     Show this screen
  --format <fmt>                Report format [default: pretty]
DOC;

function main()
{
    $args = Docopt::handle(DOCOPT);

    $result = genDiff($args['<firstFile>'], $args['<secondFile>']);

    echo $result . PHP_EOL;
}
