<?php

namespace App\CivitatisSoftware\Shared\ValueObjects;

use DomainException;

final class NonEmptyString
{
    private string $value;

    /**
     * NonEmptyString constructor.
     */
    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new DomainException('Este valor no puede estar vacío');
        }
        $this->value = $value;
    }

    public function toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
