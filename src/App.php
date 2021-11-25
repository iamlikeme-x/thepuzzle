<?php

namespace Puzzle;

use Puzzle\Factories\FactoryInterface;
use Puzzle\Readers\ReaderInterface;

class App
{
    /**
     * Inject the reader and factory into the App
     * 
     * @param ReaderInterface  $reader The reader to inject
     * @param FactoryInterface $factory The factory to inject
     */
    public function __construct(ReaderInterface $reader, FactoryInterface $factory)
    {
        $this->reader  = $reader;
        $this->factory = $factory;
    }

    public function run()
    {

    }
}