<?php

namespace Puzzle\Objects;

use Puzzle\Validators\ColumnValidatorInterface;

class Column extends AbstractPieceCollection
{
    /**
     * The column validator
     * 
     * @var ColumnValidatorInterface
     */
    protected $validator;

    /**
     * Construct a row based on the pieces
     * 
     * @param Piece[]               $pieces    The pieces
     * @param ColumnValidatorInterface $validator The row validator
     */
    public function __construct(array $pieces, ColumnValidatorInterface $validator)
    {
        $this->pieces    = $pieces;
        $this->validator = $validator;
    }
}
