<?php


namespace App\CivitatisSoftware\Shared\CustomMappings;


use App\CivitatisSoftware\Shared\ValueObjects\NonEmptyString;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class NonEmptyStringType extends Type
{
    const NON_EMPTY_STRING_TYPE = "nonEmptyStringType";

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): NonEmptyString
    {
        return new NonEmptyString($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return self::NON_EMPTY_STRING_TYPE;
    }

    public function getName(): string
    {
        // TODO: Implement getName() method.
        return self::NON_EMPTY_STRING_TYPE;
    }
}
