<?php

namespace Puzzle\Objects;

use Puzzle\Validators\RowValidatorInterface;

class Row extends AbstractPieceCollection
{
    /**
     * The row validator
     * 
     * @var RowValidatorInterface
     */
    protected $validator;

    /**
     * Construct a row based on the pieces
     * 
     * @param Piece[]               $pieces    The pieces
     * @param RowValidatorInterface $validator The row validator
     */
    public function __construct(array $pieces, RowValidatorInterface $validator)
    {
        $this->pieces    = $pieces;
        $this->validator = $validator;
    }
}