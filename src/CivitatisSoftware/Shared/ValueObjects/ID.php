<?php

namespace App\CivitatisSoftware\Shared\ValueObjects;

use DomainException;
use InvalidArgumentException;

final class ID
{
    private int $value;

    public function __construct(int $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            throw new DomainException(sprintf('No cumple con el formato esperado.'));
        }
        if (0 > $value) {
            throw new InvalidArgumentException('Un id no puede ser negativo');
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return strval($this->value);
    }
}
