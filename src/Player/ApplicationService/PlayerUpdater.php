<?php

declare(strict_types=1);

namespace App\Player\ApplicationService;

use App\Player\ApplicationService\Dto\PlayerUpdaterRequest;
use App\Player\Domain\Entity\Player;
use App\Player\Domain\Repository\PlayerRepository;
use App\Team\Domain\Repository\TeamRepository;

final readonly class PlayerUpdater
{
    public function __construct(private PlayerRepository $repository, private TeamRepository $teamRepository)
    {
    }

    public function __invoke(PlayerUpdaterRequest $request): Player
    {
        $player = $this->repository->findOrFail($request->uuid);
        $team = $this->teamRepository->findOrFail($request->teamUuid);

        $player->modify(
            name: $request->name,
            number: $request->number,
            teamUuid: $team->uuid(),
            isCaptain: $request->isCaptain
        );

        $this->repository->update($player);

        return $player;
    }
}
