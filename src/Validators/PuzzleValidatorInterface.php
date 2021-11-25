<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Puzzle;

/**
 * Validator interface for puzzles
 */
interface PuzzleValidatorInterface
{
    /**
     * Validate wether the puzzle is valid
     * 
     * @param Puzzle $puzzle The puzzle to validate
     * 
     * @return bool
     */
    public function isValid(Puzzle $puzzle): bool;
}
