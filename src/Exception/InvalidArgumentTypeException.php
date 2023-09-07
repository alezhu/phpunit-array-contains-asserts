<?php

namespace Alezhu\PHPUnitArrayContainsAsserts\Exception;

use PHPUnit\Framework\InvalidArgumentException;
use Throwable;

class InvalidArgumentTypeException extends InvalidArgumentException
{
    public function __construct(
        protected int    $argument,
        protected string $type,
        Throwable        $previous = null
    )
    {
        parent::__construct(
            message: sprintf("Argument #%d must be %s", $argument, $type),
            previous: $previous
        );
    }

    public static function create(
        int       $argument,
        string    $type,
        Throwable $previous = null
    ): static
    {
        return new static($argument, $type, $previous);
    }
}
