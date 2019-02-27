<?php

namespace DiffCalculator;

use Docopt;

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
    Docopt::handle(DOCOPT);
}
