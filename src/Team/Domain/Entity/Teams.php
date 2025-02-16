<?php

declare(strict_types=1);

namespace App\Team\Domain\Entity;

use App\Common\Domain\Collection;

final class Teams extends Collection
{
    protected function type(): string
    {
        return Team::class;
    }
}