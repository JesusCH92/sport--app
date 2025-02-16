<?php

declare(strict_types=1);

namespace App\Player\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Player\Domain\Exception\InvalidName;

final class Name extends StringValueObject
{
    private const int LENGTH_MAX = 255;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidName('Name is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidName(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }

    }
}
