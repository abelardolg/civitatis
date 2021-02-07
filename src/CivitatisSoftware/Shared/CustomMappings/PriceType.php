<?php


namespace App\CivitatisSoftware\Shared\CustomMappings;


use App\CivitatisSoftware\Shared\ValueObjects\Price;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class PriceType extends Type
{
    const PRICE_TYPE = "priceType";

    public function convertToDatabaseValue($value, AbstractPlatform $platform): float
    {
        return $value->getValue();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Price
    {
        return new Price($value);
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return self::PRICE_TYPE;
    }

    public function getName(): string
    {
        return self::PRICE_TYPE;
    }
}
