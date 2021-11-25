<?php

namespace Puzzle\Objects;

abstract class AbstractObject implements ObjectInterface
{
    /**
     * Validate the object
     */
    public function isValid(): bool
    {
        return $this->validator->isValid($this);
    }
}