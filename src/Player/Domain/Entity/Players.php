<?php

declare(strict_types=1);

namespace App\Player\Domain\Entity;

use App\Common\Domain\Collection;

final class Players extends Collection
{
    protected function type(): string
    {
        return Player::class;
    }
}
