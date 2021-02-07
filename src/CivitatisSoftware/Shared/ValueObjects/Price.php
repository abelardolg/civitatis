<?php

namespace App\CivitatisSoftware\Shared\ValueObjects;

use DomainException;
use InvalidArgumentException;

final class Price
{
    private float $value;

    public function __construct(float $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
            throw new DomainException(sprintf('%f no es un valor correcto para este dato', $value));
        }
        if ($value < 0) {
            throw new InvalidArgumentException('El precio no puede ser negativo');
        }
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function toString(): string
    {
        return strval($this->value);
    }
}
