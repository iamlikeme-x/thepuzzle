<?php

namespace Puzzle\Factories;

use Puzzle\Objects;

class PuzzleFactory
{
    /**
     * Required validators
     * 
     * @var string[]
     */
    public const REQUIRED_VALIDATORS = ['puzzle', 'row', 'column', 'piece'];

    /**
     * Validators
     * 
     * @var array
     */
    protected $validators;

    /**
     * Constructor function to inject validators
     * 
     * @param mixed[] $validators The validators to inject
     */
    public function __construct(array $validators)
    {
        foreach ($this::REQUIRED_VALIDATORS as $requiredValidator) {
            if (!isset($validators[$requiredValidator])) {
                throw new \InvalidArgumentException("Validator '$requiredValidator' is required");
            }
        }

        $this->validators = $validators;
    }

    /**
     * Create a puzzle object from an array of string representations of pieces
     * 
     * @param string[] $stringPieces The string representations of the pieces
     * 
     * @return Objects\Piece[]
     */
    public function createPieces(array $stringPieces): array
    {
        $pieces = [];
        foreach ($stringPieces as $stringPiece) {
            $pieces[] = $this->createPiece($stringPiece);
        }

        return $pieces;
    }

    /**
     * Create a puzzle
     * 
     * @param int             $width  The width of each row
     * @param Objects\Piece[] $pieces An array of puzzle pieces
     * 
     * @return Objects\Puzzle
     */
    public function createPuzzle($width, array $pieces): Objects\Puzzle
    {
        return new Objects\Puzzle($this, $this->createRows($width, $pieces), $this->getValidator("puzzle"));
    }

    /**
     * Create rows
     * 
     * @param int             $width  The width of each row
     * @param Objects\Piece[] $pieces The pieces to create rows from
     * 
     * @return Objects\Row[]
     */
    public function createRows(int $width, array $pieces): array
    {
        $pieceRows = array_chunk($pieces, $width);
        $rows = [];

        foreach ($pieceRows as $pieceRow) {
            $rows[] = $this->createRow($pieceRow);
        }

        return $rows;
    }

    /**
     * Create a row
     * 
     * @param Objects\Piece[] $pieces The pieces to create a row from
     * 
     * @return Objects\Row
     */
    public function createRow(array $pieces): Objects\Row
    {
        return new Objects\Row($pieces, $this->getValidator("row"));
    }

    /**
     * Create a column
     * 
     * @param Objects\Piece[] $pieces The pieces to create a column from
     * 
     * @return Objects\Column
     */
    public function createColumn(array $pieces): Objects\Column
    {
        return new Objects\Column($pieces, $this->getValidator("column"));
    }

    /**
     * Create a piece out of the string representation
     * 
     * @param string $piece The string representation of the piece
     * 
     * @return Objects\Piece
     */
    public function createPiece(string $piece): Objects\Piece
    {
        return new Objects\Piece($piece, $this->getValidator("piece"));
    }

    /**
     * Get the validator of "type"
     * 
     * @param string $type The type of validator to get
     * 
     * @return mixed The validator
     */
    protected function getValidator(string $type)
    {
        return $this->validators[$type];
    }
}