<?php


namespace App\CivitatisSoftware\Shared\CustomMappings;


use App\CivitatisSoftware\Shared\ValueObjects\ID;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class IDType extends Type
{
    const ID_TYPE = "idType";

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ID
    {
        return new ID($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return self::ID_TYPE;
    }

    public function getName(): string
    {
        return self::ID_TYPE;
    }
}
