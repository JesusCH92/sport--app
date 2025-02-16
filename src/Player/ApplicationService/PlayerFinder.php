<?php

declare(strict_types=1);

namespace App\Player\ApplicationService;

use App\Player\Domain\Entity\Player;
use App\Player\Domain\Repository\PlayerRepository;

final readonly class PlayerFinder
{
    public function __construct(private PlayerRepository $repository)
    {
    }

    public function __invoke(string $playerUuid): Player
    {
        return $this->repository->findOrFail($playerUuid);
    }
}
