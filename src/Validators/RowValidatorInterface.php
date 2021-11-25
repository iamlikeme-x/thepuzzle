<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Row;

/**
 * Validator interface for rows
 */
interface RowValidatorInterface
{
    /**
     * Validate wether the row is valid
     * 
     * @param Row $row The row to validate
     * 
     * @return bool
     */
    public function isValid(Row $row): bool;
}