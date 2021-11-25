<?php

namespace Puzzle\Objects;

use Puzzle\Factories\PuzzleFactory;
use Puzzle\Validators\PuzzleValidatorInterface;

/**
 * Puzzle object class
 */
class Puzzle extends AbstractObject
{
    /**
     * The rows of the puzzle
     * 
     * @var Row[]
     */
    protected $rows;

    /**
     * The validator to use
     * 
     * @var PuzzleValidatorInterface
     */
    protected $validator;

    /**
     * Constructor function to inject the pieces into the puzzle object
     * 
     * @param Row[] $row The rows to inject
     */
    public function __construct(PuzzleFactory $factory, array $rows, PuzzleValidatorInterface $validator)
    {
        $this->factory   = $factory;
        $this->rows      = $rows;
        $this->validator = $validator;
    }

    /**
     * Get the puzzle rows
     * 
     * @return Row[]
     */
    public function getRows(): array
    {
        return $this->rows;
    }

    /**
     * Get the top row
     * 
     * @return Row
     */
    public function getTopRow(): Row
    {
        return $this->getRows()[0];
    }

    /**
     * Get the columns
     * 
     * @return Column[]
     */
    public function getColumns(): array
    {
        $rowLength = $this->getTopRow()->getLength();
        $columns = [];
        for ($index = 0; $index < $rowLength; $index++) {
            $pieces = [];
            foreach ($this->getRows() as $row) {
                $pieces[] = $row->getPiece($index);
            }

            $columns[] = $this->factory->createColumn($pieces);
        }

        return $columns;
    }
}