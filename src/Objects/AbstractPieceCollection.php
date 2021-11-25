<?php

namespace Puzzle\Objects;


abstract class AbstractPieceCollection extends AbstractObject implements \Iterator
{
    /**
     * The position of the iterator
     * 
     * @var int
     */
    protected $position = 0;

    /**
     * The pieces for the row
     * 
     * @var Piece[]
     */
    protected $pieces;

    /**
     * Check whether the row is valid
     * 
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->validator->isValid($this);
    }

    /**
     * Get the length of the row
     * 
     * @return int
     */
    public function getLength(): int
    {
        return count($this->pieces);
    }

    /**
     * Get the piece at the index position
     * 
     * @param int $index The index of the piece to get
     * 
     * @return Piece
     */
    public function getPiece(int $index): Piece
    {
        if (!isset($this->pieces[$index])) {
            throw new \InvalidArgumentException("Index out of range.");
        }

        return $this->pieces[$index];
    }

    /**
     * Get the first piece for this row
     */
    public function getFirstPiece(): Piece
    {
        return $this->getPiece(array_key_first($this->pieces));
    }

    /**
     * Get the last piece for this row
     */
    public function getLastPiece(): Piece
    {
        return $this->getPiece(array_key_last($this->pieces));
    }

    public function getPieces(): array
    {
        return $this->pieces;
    }

    /**
     * Get the current item
     * 
     * @return Piece
     */
    public function current(): Piece
    {
        return $this->pieces[$this->position];
    }

    /**
     * Get the current key
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Set the next position
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Rewind the position to the beginning
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Whether the current position is valid
     * 
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->pieces[$this->position]);
    }
}
