<?php

namespace Puzzle\Factories;

use Puzzle\Objects;

interface FactoryInterface
{
    public function createFromArray(array $arr): Objects\Puzzle;
}