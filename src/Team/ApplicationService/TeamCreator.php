<?php

declare(strict_types=1);

namespace App\Team\ApplicationService;

use App\Team\ApplicationService\Dto\TeamCreatorRequest;
use App\Team\Domain\Entity\Team;
use App\Team\Domain\Repository\TeamRepository;

final readonly class TeamCreator
{
    public function __construct(private TeamRepository $repository)
    {
    }

    public function __invoke(TeamCreatorRequest $request): ?Team
    {
        $team = new Team(uuid: null, name: $request->name, city: $request->city, createdAt: $request->date);

        $this->repository->save($team);

        return $team;
    }
}