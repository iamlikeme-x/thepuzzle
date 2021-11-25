<?php
// Initialize composer

use Puzzle\App;
use Puzzle\Factories\PuzzleFactory;
use Puzzle\Readers\FileReader;
use Puzzle\Validators\ColumnValidator;
use Puzzle\Validators\PieceValidator;
use Puzzle\Validators\PuzzleValidator;
use Puzzle\Validators\RowValidator;

require_once 'vendor/autoload.php';
require_once 'src/Utils/utils.php';

if ($argc < 2) {
    die("You must specify an input file");
}

$filename = $argv[1];

$reader  = new FileReader($filename);

$validators = [
    'puzzle' => new PuzzleValidator(),
    'row'    => new RowValidator(),
    'column' => new ColumnValidator,
    'piece'  => new PieceValidator,
];

$factory = new PuzzleFactory($validators);

$app = new App($reader, $factory);

echo 'Number of solution(s): ' . $app->run() . PHP_EOL;
