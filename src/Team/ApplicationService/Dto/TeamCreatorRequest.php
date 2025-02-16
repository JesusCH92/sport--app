<?php

declare(strict_types=1);

namespace App\Team\ApplicationService\Dto;

use DateTimeImmutable;

final readonly class TeamCreatorRequest
{
    public function __construct(public string $name, public string $city, public DateTimeImmutable $date)
    {
    }
}
