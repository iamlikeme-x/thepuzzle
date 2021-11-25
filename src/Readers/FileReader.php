<?php

namespace Puzzle\Readers;

class FileReader implements ReaderInterface
{
    /**
     * Filename
     * 
     * @var string
     */
    protected $filename;

    /**
     * File object
     * 
     * @var SplFileObject
     */
    protected $file;

    /**
     * Constructor function to inject the filename
     * 
     * @param string $filename The filename to read from
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->file     = new \SplFileObject($filename, 'r');
    }

    /**
     * Read the entity and return an associative array with keys:
     *     count:  int      The number of pieces
     *     pieces: string[] The puzzle pieces as string representations
     * 
     */
    public function read(): array
    {
        $
    }
}