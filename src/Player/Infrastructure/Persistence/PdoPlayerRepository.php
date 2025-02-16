<?php

declare(strict_types=1);

namespace App\Player\Infrastructure\Persistence;

use App\Common\Infrastructure\DbConnector;
use App\Player\Domain\Entity\Player;
use App\Player\Domain\Entity\Players;
use App\Player\Domain\Exception\NotFoundPlayer;
use App\Player\Domain\Repository\PlayerRepository;
use PDO;

final class PdoPlayerRepository extends DbConnector implements PlayerRepository
{
    public function save(Player $player): void
    {
        $pdo = $this->pdo();

        $query = <<<SQL
INSERT INTO player (uuid, name, number, team_uuid, is_captain) VALUES (:uuid, :name, :number, :team_uuid, :is_captain);
SQL;

        $stmt = $pdo->prepare($query);

        $stmt->bindValue('uuid', $player->uuid());
        $stmt->bindValue('name', $player->name());
        $stmt->bindValue('number', $player->number());
        $stmt->bindValue('team_uuid', $player->teamUuid());
        $stmt->bindValue('is_captain', (int)$player->isCaptain());

        $stmt->execute();
    }

    public function searchByTeam(string $teamUuid): Players
    {
        $pdo = $this->pdo();

        $query = <<<SQL
SELECT uuid, name, number, team_uuid, is_captain FROM player
WHERE team_uuid = :team_uuid;
SQL;

        $stmt = $pdo->prepare($query);

        $stmt->bindValue('team_uuid', $teamUuid);

        $stmt->execute();

        $primitives = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydratePlayers($primitives);
    }

    private function hydratePlayers(array $primitives): Players
    {
        $collection = array_map(fn(array $primitive) => new Player(
            $primitive['uuid'],
            $primitive['name'],
            $primitive['number'],
            $primitive['team_uuid'],
            (bool)$primitive['is_captain']
        ), $primitives);

        return new Players($collection);
    }

    public function findOrFail(string $playerUuid): Player
    {
        $pdo = $this->pdo();

        $query = <<<SQL
SELECT uuid, name, number, team_uuid, is_captain FROM player WHERE uuid = :uuid LIMIT 1;
SQL;
        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':uuid', $playerUuid);

        $stmt->execute();

        $primitive = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$primitive) {
            throw new NotFoundPlayer($playerUuid);
        }

        return new Player(
            $primitive['uuid'],
            $primitive['name'],
            $primitive['number'],
            $primitive['team_uuid'],
            (bool)$primitive['is_captain']
        );
    }

    public function update(Player $player): void
    {
        $pdo = $this->pdo();

        $query = <<<SQL
UPDATE player
    SET name = :name, number = :number, team_uuid = :team_uuid, is_captain = :is_captain
    WHERE uuid = :uuid;
SQL;

        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':uuid', $player->uuid());
        $stmt->bindValue(':name', $player->name());
        $stmt->bindValue(':number', $player->number(), PDO::PARAM_INT);
        $stmt->bindValue(':team_uuid', $player->teamUuid());
        $stmt->bindValue(':is_captain', (int)$player->isCaptain(), PDO::PARAM_INT);

        $stmt->execute();
    }
}