<?php

declare(strict_types=1);

namespace App\Player\ApplicationService;

use App\Player\ApplicationService\Dto\PlayerCreatorRequest;
use App\Player\Domain\Entity\Player;
use App\Player\Domain\Repository\PlayerRepository;
use App\Team\Domain\Repository\TeamRepository;

final readonly class PlayerCreator
{
    public function __construct(private PlayerRepository $repository, private TeamRepository $teamRepository)
    {
    }

    public function __invoke(PlayerCreatorRequest $request): Player
    {
        $team = $this->teamRepository->findOrFail($request->teamUuid);

        $player = new Player(
            uuid: null,
            name: $request->name,
            number: $request->number,
            teamUuid: $team->uuid(),
            isCaptain: $request->isCaptain
        );

        $this->repository->save($player);

        return $player;
    }
}