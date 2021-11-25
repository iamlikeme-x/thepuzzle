<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Row;

/**
 * Validator class for rows
 */
class RowValidator
{
    /**
     * Validate wether the row is valid
     * 
     * @param Row $row The row to validate
     * 
     * @return bool
     */
    public function isValid(Row $row): bool
    {
        if (!$row->getFirstPiece()->isLeftEdge()) {
            return false;
        }

        if (!$row->getLastPiece()->isRightEdge()) {
            return false;
        }

        return $this->isValidOrder($row);
    }

    /**
     * Check whether the row is in a valid order
     * 
     * @param Row $row The row to validate
     * 
     * @return bool
     */
    protected function isValidOrder($row): bool
    {
        $previous = null;

        foreach ($row as $piece) {
            if (isset($previous)) {
                if ($previous->getRightSide() + $piece->getLeftSide() !== 0) {
                    return false;
                }
            }

            $previous = $piece;
        }

        return true;
    }
}
