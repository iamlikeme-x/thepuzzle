<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Puzzle;

/**
 * Validator class for Puzzles
 */
class PuzzleValidator implements PuzzleValidatorInterface
{
    /**
     * Validate wether the puzzle is valid
     * 
     * @param Puzzle $puzzle The puzzle to validate
     * 
     * @return bool
     */
    public function isValid(Puzzle $puzzle): bool
    {
        $rows = $puzzle->getRows();
        foreach ($rows as $row) {
            if (!$row->isValid()) {
                return false;
            }
        }

        $columns = $puzzle->getColumns();

        foreach ($columns as $column) {
            if (!$column->isValid()) {
                return false;
            }
        }

        return true;
    }
}