<?php

declare(strict_types=1);

namespace App\Player\Domain\Repository;

use App\Player\Domain\Entity\Player;
use App\Player\Domain\Entity\Players;

interface PlayerRepository
{
    public function save(Player $player): void;

    public function searchByTeam(string $teamUuid): Players;

    public function findOrFail(string $playerUuid): Player;

    public function update(Player $player): void;
}