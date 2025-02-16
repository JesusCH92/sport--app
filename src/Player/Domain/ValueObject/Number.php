<?php

declare(strict_types=1);

namespace App\Player\Domain\ValueObject;

use App\Common\Domain\ValueObject\IntegerValueObject;
use App\Player\Domain\Exception\InvalidNumber;

final class Number extends IntegerValueObject
{
    private const int MIN = 0;
    private const int MAX = 500;

    protected function saveIfIsAllowed(?int $value): void
    {
        if (null === $value) {
            throw new InvalidNumber('number cannot be null');
        }

        if ($value <= self::MIN || $value > self::MAX) {
            throw new InvalidNumber('the number must be between 1 - 500');
        }
    }
}
