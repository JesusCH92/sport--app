<?php

declare(strict_types=1);

namespace App\Team\Domain\ValueObject;

use App\Team\Domain\Exception\InvalidCity;

enum City: string
{
    case Barcelona = 'Barcelona';
    case Madrid = 'Madrid';

    public static function fromString(string $value): self
    {
        return match ($value) {
            self::Barcelona->value => self::Barcelona,
            self::Madrid->value => self::Madrid,
            default => throw new InvalidCity(sprintf('Invalid city: %s', $value)),
        };
    }
}
