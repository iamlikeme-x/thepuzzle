<?php

namespace Puzzle\Validators;

use Puzzle\Objects\Piece;

/**
 * Validator class for pieces
 */
class PieceValidator implements PieceValidatorInterface
{
    /**
     * Check whether the piece is a valid configuration. Pieces are valid if they have no more than two edges,
     * and they are not edges of opposite sides (top and bottom / left and right)
     * 
     * @param Piece $piece The piece to validate
     * 
     * @return bool
     */
    public function isValid(Piece $piece): bool
    {
        return $piece->getEdgeCount() <= 2
            && ! ($piece->isLeftEdge() && $piece->isRightEdge())
            && ! ($piece->isTopEdge()  && $piece->isBottomEdge());
    }
}
