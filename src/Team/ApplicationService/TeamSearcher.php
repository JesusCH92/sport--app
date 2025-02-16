<?php

declare(strict_types=1);

namespace App\Team\ApplicationService;

use App\Team\Domain\Entity\Teams;
use App\Team\Domain\Repository\TeamRepository;

final readonly class TeamSearcher
{
    public function __construct(private TeamRepository $repository)
    {
    }

    public function __invoke(): Teams
    {
        return $this->repository->search();
    }
}