<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Column;

/**
 * Validator interface for columns
 */
interface ColumnValidatorInterface
{
    /**
     * Validate wether the column is valid
     * 
     * @param Column $column The column to validate
     * 
     * @return bool
     */
    public function isValid(Column $column): bool;
}
