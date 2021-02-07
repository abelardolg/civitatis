<?php


namespace App\CivitatisSoftware\Shared\CustomMappings;


use App\CivitatisSoftware\Shared\ValueObjects\Popularity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class PopularityType extends Type
{
    const POPULARITY_TYPE = "popularityType";

    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Popularity
    {
        return new Popularity($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return self::POPULARITY_TYPE;
    }

    public function getName(): string
    {
        // TODO: Implement getName() method.
        return self::POPULARITY_TYPE;
    }
}
