<?php

namespace Objects\Piece;

use InvalidArgumentException;

class Piece
{
    /**
     * The north value
     * 
     * @var int<-1,1>
     */
    protected $north;


    /**
     * The east value
     * 
     * @var int<-1,1>
     */
    protected $east;


    /**
     * The south value
     * 
     * @var int<-1,1>
     */
    protected $south;


    /**
     * The west value
     * 
     * @var int<-1,1>
     */
    protected $west;

    /**
     * Constructor function to inject / parse the string representation of the piece
     * 
     * @param string $stringPiece The string representation of the piece
     */
    public function __construct(string $stringPiece)
    {
        $this->parse($stringPiece);
    }

    /**
     * 
     */
    public function setSide($index, $value): void
    {
        if (!in_array($value, [-1, 0, 1])) {
            throw new \InvalidArgumentException("Value must be between -1 and 1");
        }

        switch ($index) {
            case 0:
                $this->north = $value;
                break;
            case 1:
                $this->east  = $value;
                break;
            case 2:
                $this->south = $value;
                break;
            case 3:
                $this->west  = $value;
                break;
            default:
                throw new \InvalidArgumentException("Unrecognised index");
        }
    }

    /**
     * Parse the string representation of the piece into a piece
     * 
     * @param string $stringPiece The string representation of the piece
     * 
     * @return void
     * 
     * @throws \InvalidArgumentException if the piece is not 4 characters comprising solely of "S", "B", or "I"
     */
    protected function parse(string $stringPiece): void
    {
        if (!preg_match('/^[SBI]{4}$/', $stringPiece)) {
            throw new \InvalidArgumentException("Invalid piece string");
        }

        $arr = str_split($stringPiece);

        foreach ($arr as $index => $value) {
            switch ($value) {
                case 'S': // straight
                    $converted = 0;
                    break;
                case 'B': // bulge
                    $converted = 1;
                    break;
                case 'I': // indent
                    $converted = -1;
                    break;
                default:
                    throw new \InvalidArgumentException("Unrecognised piece value: '$value'");
            }

            $this->setSide($index, $converted);
        }
    }
}