<?php

namespace Puzzle;

use Puzzle\Factories\PuzzleFactory;
use Puzzle\Readers\ReaderInterface;

class App
{
    /**
     * Factory
     * 
     * @var PuzzleFactory
     */
    protected $factory;

    /**
     * Reader
     * 
     * @var ReaderInterface
     */
    protected $reader;

    /**
     * Pieces
     * 
     * @var Objects\Piece[]
     */
    protected $pieces;

    /**
     * Valid Puzzles count
     * 
     * @var int
     */
    protected $validPuzzles;

    /**
     * Valid top rows
     * 
     * @var Objects\Row[]
     */
    protected $validTopRows;

    /**
     * Valid bottom rows
     * 
     * @var Objects\Row[]
     */
    protected $validBottomRows;

    /**
     * The puzzle width
     * 
     * @var int
     */
    protected $puzzleWidth;

    /**
     * Inject the reader and factory into the App
     * 
     * @param ReaderInterface  $reader The reader to inject
     * @param PuzzleFactory $factory The factory to inject
     */
    public function __construct(ReaderInterface $reader, PuzzleFactory $factory)
    {
        $this->reader  = $reader;
        $this->factory = $factory;
    }

    public function run()
    {
        $read = $this->reader->read();

        $pieceStrings = $read['pieces'];

        $this->pieces = $this->factory->createPieces($pieceStrings);
        $this->puzzleWidth = $this->calculatePuzzleWidth();

        $this->validTopRows    = $this->findValidTopRows();
        $this->validBottomRows = $this->findValidBottomRows();

        $this->findValidPuzzles();

        return $this->validPuzzles;
    }

    /**
     * Calculate the puzzle width by counting the amount of pieces with a top edge
     * 
     * @return int
     */
    protected function calculatePuzzleWidth(): int
    {
        return count($this->getTopPieces());
    }

    /**
     * 
     */
    protected function findValidPuzzles()
    {
        $middlePieces = $this->getMiddlePieces();

        foreach ($this->validTopRows as $topRow) {
            foreach ($this->validBottomRows as $bottomRow) {
                foreach (permutations($middlePieces) as $permutation)  {
                    $rows = $this->factory->createRows($this->puzzleWidth, $permutation);
                    array_unshift($rows, $topRow);
                    $rows[] = $bottomRow;

                    $puzzle = $this->factory->createPuzzle($rows);

                    if ($puzzle->isValid()) {
                        $this->validPuzzles += 1;
                    }
                }
            }
        }
    }

    /**
     * Find valid top rows
     * 
     * @return Objects\Row[]
     */
    protected function findValidTopRows()
    {
        $pieces    = $this->getTopPieces();
        return $this->findValidRows($pieces);
    }

    /**
     * Find valid bottom rows
     * 
     * @return Objects\Row[]
     */
    protected function findValidBottomRows()
    {
        $pieces    = $this->getBottomPieces();
        return $this->findValidRows($pieces);
    }

    /**
     * Find valid rows
     * 
     * @param Objects\Piece[] $pieces The pieces to find valid combinations for
     * 
     * @return Objects\Row[]
     */
    protected function findValidRows(array $pieces): array
    {
        $validRows = [];
        $first     = $this->getFirstPiece($pieces);
        $last      = $this->getLastPiece($pieces);
        $inbetween = $this->getInbetweenPieces($pieces);

        foreach (permutations($inbetween) as $testRow) {
            // Add back in the first and last piece
            array_unshift($testRow, $first);
            $testRow[] = $last;

            $row = $this->factory->createRow($testRow);

            if ($row->isValid()) {
                $validRows[] = $row;
            }
        }

        return $validRows;
    }

    /**
     * Get an array of top pieces
     * 
     * @return Objects\Piece[]
     */
    protected function getTopPieces(): array
    {
        $topPieces = [];
        foreach ($this->pieces as $piece) {
            if ($piece->isTopEdge()) {
                $topPieces[] = $piece;
            }
        }

        return $topPieces;
    }

    /**
     * Get an array of bottom pieces
     * 
     * @return Objects\Piece[]
     */
    protected function getBottomPieces(): array
    {
        $bottomPieces = [];
        foreach ($this->pieces as $piece) {
            if ($piece->isBottomEdge()) {
                $bottomPieces[] = $piece;
            }
        }

        return $bottomPieces;
    }

    /**
     * Get an array of middle pieces (not top or bottom)
     * 
     * @return Objects\Piece[]
     */
    protected function getMiddlePieces(): array
    {
        $middlePieces = [];
        foreach ($this->pieces as $piece) {
            if (!$piece->isTopEdge() && !$piece->isBottomEdge()) {
                $middlePieces[] = $piece;
            }
        }

        return $middlePieces;
    }

    /**
     * Get the first piece from an array of pieces
     * 
     * @param Objects\Piece[] $pieces The pieces to get
     * 
     * @return Objects\Piece
     */
    protected function getFirstPiece(array $pieces): ?Objects\Piece
    {
        foreach ($pieces as $piece) {
            if ($piece->isLeftEdge()) {
                return $piece;
            }
        }

        return null;
    }

    /**
     * Get the last piece from an array of pieces
     * 
     * @param Objects\Piece[] $pieces The pieces to get
     * 
     * @return ?Objects\Piece
     */
    protected function getLastPiece(array $pieces): ?Objects\Piece
    {
        foreach ($pieces as $piece) {
            if ($piece->isRightEdge()) {
                return $piece;
            }
        }

        return null;
    }

    /**
     * Get the inbetween pieces from an array of pieces
     * 
     * @param Objects\Piece[] $pieces The pieces to get
     * 
     * @return Objects\Piece[]
     */
    protected function getInbetweenPieces(array $pieces): array
    {
        $inbetweenPieces = [];
        foreach ($pieces as $piece) {
            if (!$piece->isRightEdge() && !$piece->isLeftEdge()) {
                $inbetweenPieces[] = $piece;
            }
        }

        return $inbetweenPieces;
    }
}