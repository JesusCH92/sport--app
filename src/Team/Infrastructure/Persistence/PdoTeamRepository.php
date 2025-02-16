<?php

declare(strict_types=1);

namespace App\Team\Infrastructure\Persistence;

use App\Common\Infrastructure\DbConnector;
use App\Team\Domain\Entity\Team;
use App\Team\Domain\Entity\Teams;
use App\Team\Domain\Exception\NotFoundTeam;
use App\Team\Domain\Repository\TeamRepository;
use DateTimeImmutable;
use PDO;

final class PdoTeamRepository extends DbConnector implements TeamRepository
{
    public function search(): Teams
    {
        $pdo = $this->pdo();

        $query = <<<SQL
SELECT uuid, name, city, created_at FROM team;
SQL;

        $stmt = $pdo->prepare($query);

        $stmt->execute();

        $primitives = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->hydrateTeams($primitives);
    }

    private function hydrateTeams(array $primitives): Teams
    {
        $collection = array_map(fn(array $primitive) => new Team(
            $primitive['uuid'],
            $primitive['name'],
            $primitive['city'],
            new DateTimeImmutable($primitive['created_at'])
        ), $primitives);

        return new Teams($collection);
    }

    public function save(Team $team): void
    {
        $pdo = $this->pdo();

        $query = <<<SQL
INSERT INTO team (uuid, name, city, created_at) VALUES (:uuid, :name, :city, :created_at)
SQL;

        $stmt = $pdo->prepare($query);

        $stmt->bindValue('uuid', $team->uuid());
        $stmt->bindValue('name', $team->name());
        $stmt->bindValue('city', $team->city());
        $stmt->bindValue('created_at', $team->createdAt()->format('Y-m-d'));

        $stmt->execute();
    }

    public function findOrFail(string $teamUuid): Team
    {
        $pdo = $this->pdo();

        $query = <<<SQL
SELECT uuid, name, city, created_at FROM team WHERE uuid = :uuid LIMIT 1;
SQL;

        $stmt = $pdo->prepare($query);

        $stmt->bindValue(':uuid', $teamUuid);

        $stmt->execute();

        $primitive = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$primitive) {
            throw new NotFoundTeam($teamUuid);
        }

        return new Team(
            $primitive['uuid'],
            $primitive['name'],
            $primitive['city'],
            new DateTimeImmutable($primitive['created_at'])
        );
    }
}