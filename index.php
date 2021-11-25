<?php
// Initialize composer

use Puzzle\App;
use Puzzle\Factories\PuzzleFactory;
use Puzzle\Readers\FileReader;

require_once 'vendor/autoload.php';

if ($argc < 2) {
    die("You must specify an input file");
}

$filename = $argv[1];

$reader  = new FileReader($filename);
$factory = new PuzzleFactory();

$app = new App($reader, $factory);

$app->run();
