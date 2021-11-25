<?php

namespace Puzzle\Objects;

/**
 * Puzzle object class
 */
class Puzzle
{
    protected $pieces;
    
    /**
     * Constructor function to inject the pieces into the puzzle object
     * 
     * @param Piece[] $pieces The pieces to inject
     */
    public function __construct(array $pieces)
    {
        $this->pieces = $pieces;
    }
}