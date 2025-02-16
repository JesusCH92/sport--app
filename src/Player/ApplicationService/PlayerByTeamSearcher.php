<?php

declare(strict_types=1);

namespace App\Player\ApplicationService;

use App\Player\ApplicationService\Dto\PlayerByTeamSearcherResponse;
use App\Player\Domain\Repository\PlayerRepository;
use App\Team\Domain\Repository\TeamRepository;

final readonly class PlayerByTeamSearcher
{
    public function __construct(private PlayerRepository $repository, private TeamRepository $teamRepository)
    {
    }

    public function __invoke(string $teamUuid): PlayerByTeamSearcherResponse
    {
        $team = $this->teamRepository->findOrFail($teamUuid);

        $players = $this->repository->searchByTeam($team->uuid());

        return new PlayerByTeamSearcherResponse($players, $team);
    }
}