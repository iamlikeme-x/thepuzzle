<?php

namespace Puzzle\Factories;

use Puzzle\Objects;

class PuzzleFactory implements FactoryInterface
{
    /**
     * Create a puzzle object from an array of string representations of pieces
     * 
     * @param string[] $stringPieces The string representations of the pieces
     */
    public function createFromArray(array $stringPieces): Object\Puzzle
    {
        $pieces = [];
        foreach ($stringPieces as $stringPiece) {
            $pieces[] = $this->createPiece($stringPiece);
        }

        return $this->createPuzzle($pieces);
    }

    /**
     * Create a puzzle
     * 
     * @param Objects\Piece[] $pieces An array of puzzle pieces
     * 
     * @return Objects\Puzzle
     */
    public function createPuzzle(array $pieces): Objects\Puzzle
    {
        return new Objects\Puzzle($pieces);
    }

    /**
     * Create a piece out of the string representation
     * 
     * @param string $piece The string representation of the piece
     * 
     * @return Objects\Piece
     */
    public function createPiece(string $piece): Objects\Piece
}