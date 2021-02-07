<?php

namespace App\CivitatisSoftware\Shared\ValueObjects;

use App\CivitatisSoftware\Activity\Domain\Activity;
use DomainException;
use InvalidArgumentException;

final class Popularity
{
    private int $value;

    public function __construct(int $value, int $minValue = 0, int $maxValue = Activity::MAX_POPULARITY)
    {
        if (!filter_var($value, FILTER_VALIDATE_INT)) {
            throw new DomainException(sprintf('%d no cumple con el formato esperado', $value));
        }
        if ($value < $minValue) {
            throw new InvalidArgumentException(sprintf('Este valor no puede ser menor que %d', $minValue));
        }
        if ($value > $maxValue) {
            throw new InvalidArgumentException(sprintf('Este valor no puede ser mayor que %d', $maxValue));
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
