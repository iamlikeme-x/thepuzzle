<?php

namespace Puzzle\Readers;

use SplFileObject;

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
        $this->file->setFlags(SplFileObject::DROP_NEW_LINE);
    }

    /**
     * Read the entity and return an associative array with keys:
     *     count:  int      The number of pieces
     *     pieces: string[] The puzzle pieces as string representations
     * 
     */
    public function read(): array
    {
        $pieceStrings = [];
        while (!$this->file->eof()) {
            $line = rtrim($this->file->fgets());

            if ($line) {
                $pieceStrings[] = $line;
            }
        }

        $count = array_shift($pieceStrings);

        return [
            'count'  => $count,
            'pieces' => $pieceStrings,
        ];
    }
}