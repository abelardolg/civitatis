<?php


namespace App\CivitatisSoftware\Shared\CustomMappings;


use App\CivitatisSoftware\Shared\ValueObjects\NumPax;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class NumPaxType extends Type
{
    const NUM_PAX_TYPE = "numPaxType";

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): NumPax
    {
        return new NumPax($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return self::NUM_PAX_TYPE;
    }

    public function getName(): string
    {
        return self::NUM_PAX_TYPE;
    }
}
