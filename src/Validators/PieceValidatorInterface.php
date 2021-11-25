<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Piece;

/**
 * Validator interface for pieces
 */
interface PieceValidatorInterface
{
    /**
     * Check whether the piece is valid
     * 
     * @param Piece $piece The piece to validate
     * 
     * @return bool
     */
    public function isValid(Piece $piece): bool;
}