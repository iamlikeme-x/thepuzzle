<?php

namespace Puzzle\Readers;

interface ReaderInterface
{
    /**
     * Read the entity and return an associative array with keys:
     *     count:  int      The number of pieces
     *     pieces: string[] The puzzle pieces as string representations
     * 
     */
    public function read(): array;
}