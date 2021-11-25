<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Column;

/**
 * Validator class for columns
 */
class ColumnValidator implements ColumnValidatorInterface
{
    /**
     * Validate wether the column is valid
     * 
     * @param Column $column The column to validate
     * 
     * @return bool
     */
    public function isValid(Column $column): bool
    {
        if (!$column->getFirstPiece()->isTopEdge()) {
            return false;
        }

        if (!$column->getLastPiece()->isBottomEdge()) {
            return false;
        }

        return $this->isValidOrder($column);
    }

    /**
     * Check whether the column is in a valid order
     * 
     * @param Column $column The column to validate
     * 
     * @return bool
     */
    protected function isValidOrder($column): bool
    {
        $previous = null;

        foreach ($column as $piece) {
            if (isset($previous)) {
                if ($previous->getBottomSide() + $piece->getTopSide() !== 0) {
                    return false;
                }
            }

            $previous = $piece;
        }

        return true;
    }
}
