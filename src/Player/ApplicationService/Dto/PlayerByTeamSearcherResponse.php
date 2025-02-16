<?php

declare(strict_types=1);

namespace App\Player\ApplicationService\Dto;

use App\Player\Domain\Entity\Players;
use App\Team\Domain\Entity\Team;

final readonly class PlayerByTeamSearcherResponse
{
    public function __construct(public Players $players, public Team $team)
    {
    }
}