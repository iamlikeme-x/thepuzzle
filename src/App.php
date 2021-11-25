<?php

namespace Puzzle;

use Puzzle\Factories\PuzzleFactory;
use Puzzle\Readers\ReaderInterface;

class App
{
    /**
     * Inject the reader and factory into the App
     * 
     * @param ReaderInterface  $reader The reader to inject
     * @param FactoryInterface $factory The factory to inject
     */
    public function __construct(ReaderInterface $reader, PuzzleFactory $factory)
    {
        $this->reader  = $reader;
        $this->factory = $factory;
    }

    public function run()
    {
        $read = $this->reader->read();
        $pieceStrings = $read['pieces'];


    }
}