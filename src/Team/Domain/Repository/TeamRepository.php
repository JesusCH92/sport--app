<?php

namespace App\Team\Domain\Repository;

use App\Team\Domain\Entity\Team;
use App\Team\Domain\Entity\Teams;

interface TeamRepository
{
    public function search(): Teams;

    public function save(Team $team): void;
}