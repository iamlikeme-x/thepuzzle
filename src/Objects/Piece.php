<?php

namespace Puzzle\Objects;

use InvalidArgumentException;
use Puzzle\Validators\PieceValidatorInterface;

class Piece extends AbstractObject
{
    /**
     * Validator
     * 
     * @var PieceValidatorInterface
     */
    protected $validator;

    /**
     * The north value
     * 
     * @var int<-1,1>
     */
    protected $north;


    /**
     * The east value
     * 
     * @var int<-1,1>
     */
    protected $east;


    /**
     * The south value
     * 
     * @var int<-1,1>
     */
    protected $south;


    /**
     * The west value
     * 
     * @var int<-1,1>
     */
    protected $west;

    /**
     * Constructor function to inject / parse the string representation of the piece and validator
     * 
     * @param string                  $stringPiece The string representation of the piece
     * @param PieceValidatorInterface $validator   The validator to use
     */
    public function __construct(string $stringPiece, PieceValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->parse($stringPiece);
        if (!$this->isValid()) {
            throw new \InvalidArgumentException("A piece can have no more than two sides");
        }
    }

    /**
     * Set the side value of the piece
     * 
     * @param int $index The index of the side
     * @param int $value The value to set
     * 
     * @return void
     */
    public function setSide($index, $value): void
    {
        if (!in_array($value, [-1, 0, 1])) {
            throw new \InvalidArgumentException("Value must be between -1 and 1");
        }

        switch ($index) {
            case 0:
                $this->north = $value;
                break;
            case 1:
                $this->east  = $value;
                break;
            case 2:
                $this->south = $value;
                break;
            case 3:
                $this->west  = $value;
                break;
            default:
                throw new \InvalidArgumentException("Unrecognised index");
        }
    }

    public function isCorner(): bool
    {
        return $this->getEdgeCount() === 2;
    }

    /**
     * Get the corner type of the piece
     * 
     * @return ?string (NE, SE, SW, or NW. Null if not a corner)
     */
    public function getCornerType(): ?string
    {
        if (!$this->isCorner()) {
            return null;
        }

        $vertical   = $this->isTopEdge() ? 'N' : 'S';
        $horizontal = $this->isRightEdge() ? 'E' : 'W';

        return $vertical . $horizontal;
    }

    /**
     * Get the left side value
     * 
     * @return int
     */
    public function getLeftSide(): int
    {
        return $this->west;
    }

    /**
     * Get the right side value
     * 
     * @return int
     */
    public function getRightSide(): int
    {
        return $this->east;
    }

    /**
     * Get the bottom side value
     * 
     * @return int
     */
    public function getBottomSide(): int
    {
        return $this->south;
    }

    /**
     * Get the top side value
     * 
     * @return int
     */
    public function getTopSide(): int
    {
        return $this->north;
    }

    /**
     * Check whether this piece is a left edge
     * 
     * @return bool
     */
    public function isLeftEdge(): bool
    {
        return $this->getLeftSide() === 0;
    }

    /**
     * Check whether this piece is a right edge
     * 
     * @return bool
     */
    public function isRightEdge(): bool
    {
        return $this->getRightSide() === 0;
    }

    /**
     * Check whether this piece is a bottom edge
     * 
     * @return bool
     */
    public function isBottomEdge(): bool
    {
        return $this->getBottomSide() === 0;
    }

    /**
     * Check whether this piece is a top edge
     * 
     * @return bool
     */
    public function isTopEdge(): bool
    {
        return $this->getTopSide() === 0;
    }

    /**
     * Count the number of edges
     * 
     * @return int
     */
    public function getEdgeCount(): int
    {
        $count = 0;
        $count += $this->isLeftEdge() ? 1 : 0;
        $count += $this->isRightEdge() ? 1 : 0;
        $count += $this->isTopEdge() ? 1 : 0;
        $count += $this->isBottomEdge() ? 1 : 0;

        return $count;
    }

    /**
     * Parse the string representation of the piece into a piece
     * 
     * @param string $stringPiece The string representation of the piece
     * 
     * @return void
     * 
     * @throws \InvalidArgumentException if the piece is not 4 characters comprising solely of "S", "B", or "I"
     */
    protected function parse(string $stringPiece): void
    {
        if (!preg_match('/^[SBI]{4}$/', $stringPiece)) {
            throw new \InvalidArgumentException("Invalid piece string");
        }

        $arr = str_split($stringPiece);

        foreach ($arr as $index => $value) {
            switch ($value) {
                case 'S': // straight
                    $converted = 0;
                    break;
                case 'B': // bulge
                    $converted = 1;
                    break;
                case 'I': // indent
                    $converted = -1;
                    break;
                default:
                    throw new \InvalidArgumentException("Unrecognised piece value: '$value'");
            }

            $this->setSide($index, $converted);
        }
    }
}