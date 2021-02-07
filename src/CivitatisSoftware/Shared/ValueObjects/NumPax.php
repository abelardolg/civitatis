<?php

namespace App\CivitatisSoftware\Shared\ValueObjects;

use DomainException;
use http\Exception\InvalidArgumentException;

final class NumPax
{
    private int $value;

    public function __construct(int $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            throw new DomainException(sprintf('%d no está en el formato esperado'));
        }
        if (0 > $value) {
            throw new InvalidArgumentException(sprintf('El número de personas no puede ser negativo'));
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function toString(): string
    {
        return strval($this->value);
    }
}
